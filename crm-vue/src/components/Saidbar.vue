<script setup>

</script>

<template>
    <aside class="shadow-xl/30 flex flex-col w-17 h-screen md:w-64 bg-white">
        <RouterLink to="/" class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg text-my-blue font-semibold"><span class="hidden md:inline">Kadirov</span> Inc</h2>
        </RouterLink>

        <div class="px-3 lg:px-6 py-4 flex items-center gap-4">
            <svg width="46" height="46" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g clip-path="url(#clip0_1_2883)">
                    <path d="M9.99951 11.6724C11.2099 11.6724 13.0664 11.981 14.6021 12.5962C15.3693 12.9036 16.0124 13.2709 16.4526 13.6772C16.8879 14.079 17.0776 14.4715 17.0776 14.8608V17.0776H2.92236V14.8608C2.92243 14.4715 3.11205 14.0791 3.54736 13.6772C3.98759 13.2709 4.63069 12.9036 5.39795 12.5962C6.93338 11.9811 8.78913 11.6724 9.99951 11.6724ZM9.99951 2.92236C11.7615 2.92236 13.1888 4.34893 13.189 6.11084C13.189 7.87285 11.7615 9.30029 9.99951 9.30029C8.2377 9.30006 6.81104 7.87271 6.81104 6.11084C6.81115 4.34907 8.23777 2.9226 9.99951 2.92236Z" stroke="#C2CFE0" stroke-width="1.4"/>
                </g>
                <defs>
                    <clipPath id="clip0_1_2883">
                        <rect width="20" height="20" fill="white"/>
                    </clipPath>
                </defs>
            </svg>
            <div class="hidden md:flex flex-col">
                <span class="text-sm font-medium text-gray-900">Ameliya</span>
                <span class="text-xs font-medium text-gray-500">ameliya.cer@gmail.com</span>
            </div>
        </div>

        <div class="px-6 py-4 flex flex-col gap-4 border-b border-gray-200 text-my-gray">
            <RouterLink :to="{ name: 'users' }" active-class="text-my-blue" class="flex gap-3.5 items-center">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0_1_2883)">
                        <path d="M9.99951 11.6724C11.2099 11.6724 13.0664 11.981 14.6021 12.5962C15.3693 12.9036 16.0124 13.2709 16.4526 13.6772C16.8879 14.079 17.0776 14.4715 17.0776 14.8608V17.0776H2.92236V14.8608C2.92243 14.4715 3.11205 14.0791 3.54736 13.6772C3.98759 13.2709 4.63069 12.9036 5.39795 12.5962C6.93338 11.9811 8.78913 11.6724 9.99951 11.6724ZM9.99951 2.92236C11.7615 2.92236 13.1888 4.34893 13.189 6.11084C13.189 7.87285 11.7615 9.30029 9.99951 9.30029C8.2377 9.30006 6.81104 7.87271 6.81104 6.11084C6.81115 4.34907 8.23777 2.9226 9.99951 2.92236Z" stroke="currentColor" stroke-width="1.4"/>
                    </g>
                    <defs>
                        <clipPath id="clip0_1_2883">
                            <rect width="20" height="20" fill="white"/>
                        </clipPath>
                    </defs>
                </svg>
                <span class="hidden md:inline text-[13px] font-medium text-my-blue-gray">Foydalanuvchilar</span>
            </RouterLink>
            <RouterLink :to="{ name: 'companies' }" active-class="text-my-blue" class="flex gap-3.5 items-center">
                <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0.699951 5.94995L8.19995 0.699951L15.7 5.94995V14.2C15.7 14.5978 15.5244 14.9793 15.2118 15.2606C14.8992 15.5419 14.4753 15.7 14.0333 15.7H2.36662C1.92459 15.7 1.50067 15.5419 1.18811 15.2606C0.875546 14.9793 0.699951 14.5978 0.699951 14.2V5.94995Z" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M5.69995 15.7V7.69995H10.7V15.7" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <span class="hidden md:inline text-[13px] font-medium text-my-blue-gray">Kompaniyalar</span>
            </RouterLink>
            <RouterLink :to="{ name: 'clients' }" active-class="text-my-blue" class="flex gap-3.5 items-center">
                <svg width="20" height="15" viewBox="0 0 20 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M13.7 13.7V12.3666C13.7 11.6594 13.3575 10.9811 12.748 10.481C12.1386 9.9809 11.3119 9.69995 10.45 9.69995H3.94995C3.088 9.69995 2.26135 9.9809 1.65185 10.481C1.04236 10.9811 0.699951 11.6594 0.699951 12.3666V13.7" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M6.69995 6.69995C8.35681 6.69995 9.69995 5.35681 9.69995 3.69995C9.69995 2.0431 8.35681 0.699951 6.69995 0.699951C5.0431 0.699951 3.69995 2.0431 3.69995 3.69995C3.69995 5.35681 5.0431 6.69995 6.69995 6.69995Z" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M18.7 13.7V12.3371C18.6993 11.7332 18.4043 11.1465 17.8613 10.6692C17.3183 10.1918 16.5581 9.85093 15.7 9.69995" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M12.7 1.69995C13.5581 1.87051 14.3188 2.25791 14.8619 2.80109C15.4051 3.34428 15.7 4.01234 15.7 4.69995C15.7 5.38757 15.4051 6.05563 14.8619 6.59881C14.3188 7.14199 13.5581 7.5294 12.7 7.69995" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <span class="hidden md:inline text-[13px] font-medium text-my-blue-gray">Mijozlar</span>
            </RouterLink>
        </div>
        <div class="px-6 py-4 flex flex-col justify-between h-full text-my-gray">
            <button class="flex gap-3.5 items-center">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0_1_86)">
                        <path d="M4.99992 8.33337C4.08325 8.33337 3.33325 9.08337 3.33325 10C3.33325 10.9167 4.08325 11.6667 4.99992 11.6667C5.91659 11.6667 6.66659 10.9167 6.66659 10C6.66659 9.08337 5.91659 8.33337 4.99992 8.33337ZM14.9999 8.33337C14.0833 8.33337 13.3333 9.08337 13.3333 10C13.3333 10.9167 14.0833 11.6667 14.9999 11.6667C15.9166 11.6667 16.6666 10.9167 16.6666 10C16.6666 9.08337 15.9166 8.33337 14.9999 8.33337ZM9.99992 8.33337C9.08325 8.33337 8.33325 9.08337 8.33325 10C8.33325 10.9167 9.08325 11.6667 9.99992 11.6667C10.9166 11.6667 11.6666 10.9167 11.6666 10C11.6666 9.08337 10.9166 8.33337 9.99992 8.33337Z" fill="currentColor"/>
                    </g>
                    <defs>
                        <clipPath id="clip0_1_86">
                            <rect width="20" height="20" fill="white"/>
                        </clipPath>
                    </defs>
                </svg>
                <span class="hidden md:inline text-[13px] font-medium text-my-blue-gray">Sozlamalar</span>
            </button>
            <RouterLink :to="{ name: 'login' }" class="flex gap-3.5 items-center">
                <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0_1_83)">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M2 0C0.895431 0 0 0.89543 0 2V12C0 13.1046 0.89543 14 2 14H12C13.1046 14 14 13.1046 14 12V2C14 0.895431 13.1046 0 12 0H2ZM5 2C4.44772 2 4 2.44772 4 3V11C4 11.5523 4.44772 12 5 12C5.55228 12 6 11.5523 6 11V3C6 2.44772 5.55228 2 5 2Z" fill="#C2CFE0"/>
                    </g>
                    <defs>
                        <clipPath id="clip0_1_83">
                            <rect width="14" height="14" fill="white"/>
                        </clipPath>
                    </defs>
                </svg>
                <span class="hidden md:inline text-[13px] font-medium text-my-blue-gray">Chiqish</span>
            </RouterLink>
        </div>
    </aside>
</template>
