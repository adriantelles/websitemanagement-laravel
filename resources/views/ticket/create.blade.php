@extends('layouts.client-area')

@section('content')
<div class="container main-container">
    <h2 class="is-title is-2">Create a new ticket</h2>

    <form role="form" method="POST" action="{{ route('tickets.index') }}">
        {{ csrf_field() }}

        <p class="control">
            <input class="input{{ $errors->has('title') ? ' is-danger' : '' }}" name="title" type="text" placeholder="Title" value="{{ old('title') }}" required>

            @if ($errors->has('title'))
                <span class="help is-danger">{{ $errors->first('title') }}</span>
            @endif
        </p>

        <p class="control">
            <textarea class="textarea{{ $errors->has('message') ? ' is-danger' : '' }}" name="message" type="text" placeholder="Message" style="min-height: 200px;" required></textarea>

            @if ($errors->has('message'))
                <span class="help is-danger">{{ $errors->first('message') }}</span>
            @endif
        </p>

        @can ('createForUser', \App\Ticket::class)
            <p class="control">
                <ticket-user-select endpoint="/client-area/users"></ticket-user-select>
            </p>
        @endcan

        <p class="control">
            <message-attachments upload-to="{{ route('tickets.file_upload') }}" ref="attachments"></message-attachments>
        </p>

        <p class="control">
            <button type="submit" class="button is-wide is-primary">
                Create
            </button>
        </p>
    </form>
</div>
@endsection