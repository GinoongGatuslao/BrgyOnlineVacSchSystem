<div>
    <!-- This example requires Tailwind CSS v2.0+ -->
    @if (count($notifications) > 0)
    <div class="justify-between py-3 text-right">
        <span class="italic font-bold text-blue-600 text-md hover:cursor-pointer hover:underline">Mark all read</span>
    </div>
    @endif
    <ul role="list" class="mx-auto space-y-1">
        @if (count($notifications) == 0)
        <li class="py-4">
            <span class="italic tracking-widest text-gray-500">No notifications to show...</span>
        </li>
        @else
        @foreach ($notifications as $notification)
            @if ($notification->seen == 0)
            <li wire:click="markSeen({{ $notification->id }},{{ $notification->appointment_date_id }})" class="p-2 text-right bg-blue-500 hover:cursor-pointer md:py-1 rounded-xl md:bg-gradient-to-l">
                    <span class="pr-5 italic font-extrabold text-white whitespace-pre-wrap text-md">
                        {{ $notification->message }}
                    </span>
            </li>
            @else
            <li wire:click="markSeen({{ $notification->id }},{{ $notification->appointment_date_id }})" class="p-2 text-right bg-white hover:cursor-pointer md:py-1 rounded-xl md:rounded-tl-sm md:rounded-bl-full md:bg-gradient-to-r md:from-transparent md:to-slate-200 md:via-slate-100">
                <span class="pr-5 font-medium text-blue-500 whitespace-pre-wrap rounded-lg text-md">
                    {{ $notification->message }}
                </span>
            </li>
            @endif
        @endforeach
        @endif
        
        
    </ul>
  
</div>
