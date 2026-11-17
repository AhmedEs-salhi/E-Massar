@props([
    'title'
])
<div {{$attributes->merge(['class' => "card card-border bg-base-100 w-xs border"])}}>
    <div class="card-body">
        <h1 class="card-title text-xl font-bold"> {{ $title }} </h1>
        {{ $slot }}
    </div>
</div>
