@props(['message', 'type'])

<style>
    #pop-alert-wrapper {
        z-index: 1100;
    }
</style>

<div id="pop-alert-wrapper" class="position-fixed d-flex w-100 pt-3">
    <div class="mx-auto w-25 alert alert-{{ $type }} alert-dismissible fade show" role="alert">
        {{ $message }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
</div>
