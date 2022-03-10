<div class="flex flex-col items-center min-h-screen pt-6 space-y-4 bg-indigo-600 sm:justify-center sm:pt-0">
    <div>
        {{ $logo }}
    </div>
    <div>
        {{ $appName }}
    </div>

    <div class="px-6 py-4 mt-6 overflow-hidden bg-white shadow-md w-screen-30 sm:rounded-lg">
        {{ $slot }}
    </div>
</div>
