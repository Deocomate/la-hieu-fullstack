@extends('components.layouts.main-client')

@section('title', 'Contact')

@section('content')
    @include('client.contact.partials.contact-main-section')

    @include('components.clients.follow-section')
@endsection
