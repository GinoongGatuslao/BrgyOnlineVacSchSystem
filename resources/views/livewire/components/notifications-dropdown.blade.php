<div>
    <!-- This example requires Tailwind CSS v2.0+ -->
    <ul role="list" class="mx-auto divide-y divide-gray-200">
        @if (count($notifications) == 0)
        <li class="py-4">
            <span class="italic tracking-widest text-gray-500">No notifications to show...</span>
        </li>
        @else
        @foreach ($notifications as $notification)
            @if ($notification->seen == 0)
            <li class="py-4 bg-gray-300">
                <span class="pl-2 font-medium text-gray-500 text-md">
                    {{ $notification->message }}
                </span>
            </li>
            @else
            <li class="py-4">
                <span class="pl-2 font-medium text-gray-500 text-md">
                    {{ $notification->message }}
                </span>
            </li>
            @endif
        @endforeach
        @endif
        
        
    </ul>
  
</div>
