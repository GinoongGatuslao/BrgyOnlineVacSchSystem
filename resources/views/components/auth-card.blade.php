<div class="flex flex-col items-center min-h-screen pt-6 space-y-4 bg-indigo-600 sm:justify-center sm:pt-0">
    <div>
        {{ $logo }}
    </div>
    <div class="text-center">
        {{ $appName }}
    </div>

    <div class="px-5 py-4 mt-6 overflow-auto rounded-lg shadow-md w-screen-90 bg-slate-100 sm:w-screen-50 md:w-screen-30 md:overflow-hidden">
        {{ $slot }}
    </div>
</div>
