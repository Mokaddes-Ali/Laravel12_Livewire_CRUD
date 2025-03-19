<div>
    <div class="bg-white rounded-lg" x-data="{ open: @entangle('selectedUser') !== null }" x-show="open">
        <!-- Fixed Header -->
        <div class="fixed bg-white w-5xl rounded-lg z-10">
            <div class="flex justify-between items-center border-b pb-2 mb-2">
                <h3 class="text-lg font-semibold">
                    Chat with <span class="text-blue-500">{{ $selectedUser ? $selectedUser->name : '...' }}</span>
                </h3>
                <button class="text-red-500 bg-amber-100 p-3 rounded-2xl" wire:click="closeChat">Close Chat</button>
            </div>
        </div>
        <!-- Message Container with Smooth Scroll -->
        <div class="overflow-y-auto h-[calc(100vh-100px)] py-16 scroll-smooth">
            <div class="grid pb-11">
                <div class="flex gap-2.5 mb-4">
                    <img src="https://pagedone.io/asset/uploads/1710412177.png" alt="Shanay image" class="w-10 h-11">
                    <div class="grid">
                        <h5 class="text-gray-900 text-sm font-semibold leading-snug pb-1">Shanay cruz</h5>
                        <div class="w-max grid">
                            <div class="px-3.5 py-2 bg-gray-100 rounded justify-start  items-center gap-3 inline-flex">
                                <h5 class="text-gray-900 text-sm font-normal leading-snug">Guts, I need a review of work. Are you ready?</h5>
                            </div>
                            <div class="justify-end items-center inline-flex mb-2.5">
                                <h6 class="text-gray-500 text-xs font-normal leading-4 py-1">05:14 PM</h6>
                            </div>
                        </div>
                        <div class="w-max grid">
                            <div class="px-3.5 py-2 bg-gray-100 rounded justify-start items-center gap-3 inline-flex">
                                <h5 class="text-gray-900 text-sm font-normal leading-snug">Let me know</h5>
                            </div>
                            <div class="justify-end items-center inline-flex mb-2.5">
                                <h6 class="text-gray-500 text-xs font-normal leading-4 py-1">05:14 PM</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex gap-2.5 justify-end pb-40">
                <div class="">
                    <div class="grid mb-2">
                        <h5 class="text-right text-gray-900 text-sm font-semibold leading-snug pb-1">You</h5>
                        <div class="px-3 py-2 bg-indigo-600 rounded">
                            <h2 class="text-white text-sm font-normal leading-snug">Yes, let’s see, send your work here</h2>
                        </div>
                        <div class="justify-start items-center inline-flex">
                            <h3 class="text-gray-500 text-xs font-normal leading-4 py-1">05:14 PM</h3>
                        </div>
                    </div>
                    <div class="justify-center">
                        <div class="grid w-fit ml-auto">
                            <div class="px-3 py-2 bg-indigo-600 rounded ">
                                <h2 class="text-white text-sm font-normal leading-snug">Anyone on for lunch today</h2>
                            </div>
                            <div class="justify-start items-center inline-flex">
                                <h3 class="text-gray-500 text-xs font-normal leading-4 py-1">You</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <img src="https://pagedone.io/asset/uploads/1704091591.png" alt="Hailey image" class="w-10 h-11">
            </div>
        </div>

        <!-- Fixed Input Area -->
        <div class="fixed bg-white w-5xl rounded-lg z-10">
            <div class="w-full pl-3 pr-1 py-1 rounded-3xl border border-gray-200 items-center gap-2 inline-flex justify-between">
                <div class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
                        <g id="User Circle">
                            <path id="icon" d="M6.05 17.6C6.05 15.3218 8.26619 13.475 11 13.475C13.7338 13.475 15.95 15.3218 15.95 17.6M13.475 8.525C13.475 9.89191 12.3669 11 11 11C9.6331 11 8.525 9.89191 8.525 8.525C8.525 7.1581 9.6331 6.05 11 6.05C12.3669 6.05 13.475 7.1581 13.475 8.525ZM19.25 11C19.25 15.5563 15.5563 19.25 11 19.25C6.44365 19.25 2.75 15.5563 2.75 11C2.75 6.44365 6.44365 2.75 11 2.75C15.5563 2.75 19.25 6.44365 19.25 11Z" stroke="#4F46E5" stroke-width="1.6" />
                        </g>
                    </svg>
                    <input class="grow shrink basis-0 text-black text-xs font-medium leading-4 focus:outline-none" placeholder="Type here...">
                </div>
                <div class="flex items-center gap-2">
                    <svg class="cursor-pointer" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
                        <g id="Attach 01">
                            <g id="Vector">
                                <path d="M14.9332 7.79175L8.77551 14.323C8.23854 14.8925 7.36794 14.8926 6.83097 14.323C6.294 13.7535 6.294 12.83 6.83097 12.2605L12.9887 5.72925M12.3423 6.41676L13.6387 5.04176C14.7126 3.90267 16.4538 3.90267 17.5277 5.04176C18.6017 6.18085 18.6017 8.02767 17.5277 9.16676L16.2314 10.5418M16.8778 9.85425L10.72 16.3855C9.10912 18.0941 6.49732 18.0941 4.88641 16.3855C3.27549 14.6769 3.27549 11.9066 4.88641 10.198L11.0441 3.66675" stroke="#9CA3AF" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M14.9332 7.79175L8.77551 14.323C8.23854 14.8925 7.36794 14.8926 6.83097 14.323C6.294 13.7535 6.294 12.83 6.83097 12.2605L12.9887 5.72925M12.3423 6.41676L13.6387 5.04176C14.7126 3.90267 16.4538 3.90267 17.5277 5.04176C18.6017 6.18085 18.6017 8.02767 17.5277 9.16676L16.2314 10.5418M16.8778 9.85425L10.72 16.3855C9.10912 18.0941 6.49732 18.0941 4.88641 16.3855C3.27549 14.6769 3.27549 11.9066 4.88641 10.198L11.0441 3.66675" stroke="black" stroke-opacity="0.2" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M14.9332 7.79175L8.77551 14.323C8.23854 14.8925 7.36794 14.8926 6.83097 14.323C6.294 13.7535 6.294 12.83 6.83097 12.2605L12.9887 5.72925M12.3423 6.41676L13.6387 5.04176C14.7126 3.90267 16.4538 3.90267 17.5277 5.04176C18.6017 6.18085 18.6017 8.02767 17.5277 9.16676L16.2314 10.5418M16.8778 9.85425L10.72 16.3855C9.10912 18.0941 6.49732 18.0941 4.88641 16.3855C3.27549 14.6769 3.27549 11.9066 4.88641 10.198L11.0441 3.66675" stroke="black" stroke-opacity="0.1" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
                            </g>
                        </g>
                    </svg>
                    <svg class="cursor-pointer" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
                        <g id="Microphone">
                            <path id="icon" d="M11 2.25C9.67392 2.25 8.5 3.42392 8.5 4.75V10.25C8.5 11.5761 9.67392 12.75 11 12.75C12.3261 12.75 13.5 11.5761 13.5 10.25V4.75C13.5 3.42392 12.3261 2.25 11 2.25ZM16 10.25C16 8.63517 15.1587 7.20967 14.0808 6.25714C14.0867 6.24727 14.0926 6.23732 14.0985 6.22732C14.4761 5.87785 14.5 5.23162 14.5 4.75C14.5 2.88071 13.1193 1.5 11 1.5C8.88071 1.5 7.5 2.88071 7.5 4.75C7.5 5.23162 7.52394 5.87785 7.90149 6.22732C7.90741 6.23732 7.91329 6.24727 7.91922 6.25714C6.84131 7.20967 6 8.63517 6 10.25C6 11.4964 6.44772 12.5 7.25 12.5H14.75C15.5523 12.5 16 11.4964 16 10.25Z" fill="#9CA3AF"/>
                        </g>
                    </svg>
                </div>
            </div>
        </div>
    </div>
</div>

