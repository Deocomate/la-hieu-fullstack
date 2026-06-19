<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const prefersReducedMotion = window.matchMedia &&
            window.matchMedia('(prefers-reduced-motion: reduce)').matches;

        if (window.AOS) {
            window.AOS.init({
                duration: prefersReducedMotion ? 0 : 800,
                easing: 'ease-out-cubic',
                once: true,
                offset: 50,
                disable: prefersReducedMotion,
            });
        }

        const typingElements = document.querySelectorAll('.typing-effect');

        function wrapTextNode(textNode) {
            const fragment = document.createDocumentFragment();
            const parts = textNode.nodeValue.match(/(\s+|[^\s]+)/g) || [];

            parts.forEach((part) => {
                if (/^\s+$/.test(part)) {
                    fragment.appendChild(document.createTextNode(part));
                    return;
                }

                const word = document.createElement('span');
                word.className = 'typing-word';
                word.textContent = part;
                fragment.appendChild(word);
            });

            textNode.parentNode.replaceChild(fragment, textNode);
        }

        function prepareTypingElement(element) {
            if (element.dataset.typingReady === 'true') {
                return;
            }

            const walker = document.createTreeWalker(
                element,
                NodeFilter.SHOW_TEXT, {
                    acceptNode(node) {
                        const parent = node.parentElement;

                        if (!node.nodeValue.trim() || !parent) {
                            return NodeFilter.FILTER_REJECT;
                        }

                        if (parent.closest('.typing-word') || parent.closest('script, style, noscript')) {
                            return NodeFilter.FILTER_REJECT;
                        }

                        return NodeFilter.FILTER_ACCEPT;
                    },
                }
            );

            const textNodes = [];
            while (walker.nextNode()) {
                textNodes.push(walker.currentNode);
            }

            textNodes.forEach(wrapTextNode);
            element.dataset.typingReady = 'true';
        }

        typingElements.forEach(prepareTypingElement);

        if (prefersReducedMotion || !('IntersectionObserver' in window)) {
            document.querySelectorAll('.typing-word').forEach((word) => {
                word.classList.add('is-visible');
            });
            return;
        }

        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) {
                    return;
                }

                const words = entry.target.querySelectorAll('.typing-word');

                words.forEach((word, index) => {
                    window.setTimeout(() => {
                        word.classList.add('is-visible');
                    }, index * 50);
                });

                observer.unobserve(entry.target);
            });
        }, {
            threshold: 0.1,
        });

        typingElements.forEach((element) => observer.observe(element));
    });
</script>
