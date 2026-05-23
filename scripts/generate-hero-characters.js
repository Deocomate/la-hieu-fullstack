const fs = require('fs');
const path = require('path');
const opentype = require('opentype.js');

const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!?&#@'.split('');
const targetHeight = 215;

const repoRoot = path.resolve(__dirname, '..');
const fontPath = path.resolve(
  repoRoot,
  'public/client/assets/fonts/BeVietnam-ExtraBold.ttf',
);
const outputDir = path.resolve(
  repoRoot,
  'public/client/assets/static/hero-characters',
);

const fileNames = {
  '?': 'question',
  '!': 'exclamation',
  '&': 'ampersand',
  '#': 'hash',
  '@': 'at',
};

function getFileName(char) {
  return fileNames[char] || char.toLowerCase();
}

function getGradientId(fileName) {
  return `paint0_linear_${fileName.replace(/[^a-z0-9]+/g, '_')}`;
}

function getSvgDimension(value) {
  return Math.ceil(value - 0.001);
}

function renderCharacter(font, char) {
  const testPath = font.getPath(char, 0, 0, 100);
  const testBBox = testPath.getBoundingBox();
  const testHeight = testBBox.y2 - testBBox.y1;

  if (testHeight <= 0) {
    throw new Error(`Unable to calculate height for character "${char}"`);
  }

  const targetFontSize = (targetHeight / testHeight) * 100;
  const pathAtTargetSize = font.getPath(char, 0, 0, targetFontSize);
  const bbox = pathAtTargetSize.getBoundingBox();

  const width = bbox.x2 - bbox.x1;
  const height = bbox.y2 - bbox.y1;
  const viewBoxWidth = getSvgDimension(width);
  const viewBoxHeight = getSvgDimension(height);
  const offsetX = -bbox.x1;
  const offsetY = -bbox.y1;
  const fileName = getFileName(char);
  const gradientId = getGradientId(fileName);
  const centerX = (width / 2).toFixed(4);
  const finalPathData = font
    .getPath(char, offsetX, offsetY, targetFontSize)
    .toPathData(3);

  return {
    fileName,
    width,
    height,
    svg: `<svg width="${viewBoxWidth}" height="${viewBoxHeight}" viewBox="0 0 ${viewBoxWidth} ${viewBoxHeight}" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="${finalPathData}" fill="url(#${gradientId})"/>
<defs>
<linearGradient id="${gradientId}" x1="${centerX}" y1="0" x2="${centerX}" y2="${height.toFixed(3)}" gradientUnits="userSpaceOnUse">
<stop stop-color="#F7F7F7" stop-opacity="0"/>
<stop offset="1" stop-color="#F7F7F7"/>
</linearGradient>
</defs>
</svg>
`,
  };
}

function main() {
  if (!fs.existsSync(fontPath)) {
    throw new Error(`Font file not found: ${fontPath}`);
  }

  fs.mkdirSync(outputDir, { recursive: true });

  opentype.load(fontPath, (err, font) => {
    if (err) {
      throw err;
    }

    chars.forEach((char) => {
      const result = renderCharacter(font, char);
      const outputPath = path.join(
        outputDir,
        `hero-character-${result.fileName}.svg`,
      );

      fs.writeFileSync(outputPath, result.svg);
      console.log(
        `Generated: ${path.relative(repoRoot, outputPath)} (Width: ${result.width.toFixed(3)}, Height: ${result.height.toFixed(3)})`,
      );
    });

    console.log('Finished generating hero character SVGs.');
  });
}

main();
