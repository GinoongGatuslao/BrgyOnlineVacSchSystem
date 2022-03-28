<div x-data="{showVerifyButton:@entangle('showVerifyButton'),showVerificationError:@entangle('showVerificationError'), showSendCode:@entangle('showSendCode'), showVerificationBlock:@entangle('showVerificationBlock'), resendable:@entangle('resendable') }">
    <p class="py-2 my-2">Use this code for now : {{ $code_sent }}</p>
    <button class="px-3 py-1 my-3 mr-3 text-center text-white bg-blue-400 rounded-full hover:bg-blue-600 active:ring-2 active:ring-blue-600 active:ring-offset-2" x-cloak x-show="showVerifyButton" wire:click="showsendcode">Verify Phone Number</button>
    <button class="px-3 py-1 my-3 mr-3 text-center text-white bg-blue-400 rounded-full hover:bg-blue-600 active:ring-2 active:ring-blue-600 active:ring-offset-2" x-cloak x-show="showSendCode" wire:click="sendCode">Send Code</button>
    <p class="block text-sm text-gray-700"  x-cloak x-show="showVerificationBlock">Verification code was sent to your contact number +639*******{{ substr($patient->contact_number, -4) }}</p>
    <p class="block text-sm text-gray-700" x-cloak x-show="showVerificationBlock"><strong class="italic text-gray-600" x-cloak x-show="resendable == false" >Resend Code</strong><strong class="italic underline hover:cursor-pointer active:text-blue-500" x-cloak x-show="resendable" wire:click="resendCode">Resend Code</strong> after <span wire:poll.1000ms='countdown({{ $shouldCountdown }})'>{{ $countdownsecs }}s</span></p>
    
 <div class="flex w-full max-w-md mt-5" x-cloak x-show="showVerificationBlock">
     <input type="text" wire:model="code" name="verificationCode" id="verificationCode" class="text-gray-900 border border-blue-400 rounded-l-full text-md tract w-23 focus:border-blue-600 focus:text-blue-600" placeholder="- - - - -" maxlength="6">
     <button wire:click="verifyCode" type="button" class="px-5 text-center text-white bg-blue-400 rounded-r-full w-sm active:ring-2 active:ring-offset-2 active:ring-blue-400 hover:bg-white hover:text-blue-600 hover:border-blue-600 hover:border-2">Verify Code</button>
 </div>
 <p class="block pl-1 mt-2 text-sm text-red-500"  x-cloak x-show="showVerificationError">Invalid verification code</p>
 
</div>
