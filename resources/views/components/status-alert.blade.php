@props(['status'])

@if (session($status))
    <div class="alert-success rounded-t-lg">
        <p style="padding: 0.3%; text-align: center">{{ session($status) }}</p>
    </div>
@endif
