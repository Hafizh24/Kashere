<div class="relative flex h-full max-h-full flex-col">
    <div class="px-6 pt-4">
        <h1 class="text-3xl font-bold text-lime-700">{{ config('app.name') }}</h1>
    </div>

    <!-- Content -->
    <div
        class="h-full overflow-y-auto [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-thumb]:bg-gray-300 [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar]:w-2">
        <nav class="hs-accordion-group flex w-full flex-col flex-wrap p-3" data-hs-accordion-always-open>
            <ul class="flex flex-col space-y-1">
                <li>
                    <a class="flex items-center gap-x-3.5 rounded-lg bg-gray-100 px-2.5 py-2 text-sm text-gray-800 hover:bg-gray-100 focus:bg-gray-100 focus:outline-none"
                        href="#">
                        <x-lucide-home class="size-5" />
                        Dashboard
                    </a>
                </li>

                <li><a class="flex w-full items-center gap-x-3.5 rounded-lg px-2.5 py-2 text-sm text-gray-800 hover:bg-gray-100"
                        href="#">
                        <x-lucide-file-plus class="size-5" />
                        Add Transaction
                    </a></li>

                <li class="hs-accordion" id="account-accordion">
                    <button type="button"
                        class="hs-accordion-toggle flex w-full items-center gap-x-3.5 rounded-lg px-2.5 py-2 text-start text-sm text-gray-800 hover:bg-gray-100 focus:bg-gray-100 focus:outline-none"
                        aria-expanded="true" aria-controls="account-accordion-child">
                        <x-lucide-users class="size-5" />
                        Account

                        <svg class="size-4 ms-auto hidden hs-accordion-active:block" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m18 15-6-6-6 6" />
                        </svg>

                        <svg class="size-4 ms-auto block hs-accordion-active:hidden" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m6 9 6 6 6-6" />
                        </svg>
                    </button>

                    <div id="account-accordion-child"
                        class="hs-accordion-content hidden w-full overflow-hidden transition-[height] duration-300"
                        role="region" aria-labelledby="account-accordion">
                        <ul class="space-y-1 ps-8 pt-1">
                            <li>
                                <a class="flex items-center gap-x-3.5 rounded-lg px-2.5 py-2 text-sm text-gray-800 hover:bg-gray-100 focus:bg-gray-100 focus:outline-none"
                                    href="#">
                                    <x-lucide-user-round-pen class="size-5" />
                                    Edit profile
                                </a>
                            </li>
                            <li>
                                <a class="flex items-center gap-x-3.5 rounded-lg px-2.5 py-2 text-sm text-gray-800 hover:bg-gray-100 focus:bg-gray-100 focus:outline-none"
                                    href="#">
                                    <x-lucide-log-out class="size-5" />
                                    Logout
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>



            </ul>
        </nav>
    </div>
    <!-- End Content -->
</div>
