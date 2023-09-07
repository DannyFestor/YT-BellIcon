<x-app-layout>
    <main class="flex gap-16">

        <div>
            <div id="public" class="relative w-6 h-6">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor"
                     class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0"/>
                </svg>
                <div
                    class="absolute top-0 right-0 translate-x-1/2 -translate-y-1/2 w-4 h-4 rounded-full bg-red-600 text-white justify-center items-center hidden"></div>
            </div>
            <ol id="public_titles" class="list-decimal"></ol>
        </div>

        <div>
            <div id="private" class="relative w-6 h-6">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor"
                     class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0"/>
                </svg>
                <div
                    class="absolute top-0 right-0 translate-x-1/2 -translate-y-1/2 w-4 h-4 rounded-full bg-red-600 text-white justify-center items-center hidden"></div>
            </div>
            <ol id="private_titles" class="list-decimal"></ol>
        </div>
    </main>
    <script>
        let publicNotifications = [];
        let privateNotifications = [];

        const publicBell = document.querySelector('#public');
        const privateBell = document.querySelector('#private');

        const updateNotifications = () => {
            const publicBellCount = publicBell.querySelector('div');
            const privateBellCount = privateBell.querySelector('div');

            axios.get('{{ route('polling.js.get') }}')
                .then(res => {
                    if (res.data.public && res.data.public.length > 0) {
                        publicBellCount.innerText = res.data.public.length;
                        publicBellCount.classList.remove('hidden');
                        publicBellCount.classList.add('flex');
                        publicNotifications = res.data.public;
                    } else {
                        publicBellCount.innerText = '';
                        publicBellCount.classList.remove('flex');
                        publicBellCount.classList.add('hidden');
                        publicNotifications = [];
                    }

                    if (res.data.private && res.data.private.length > 0) {
                        privateBellCount.innerText = res.data.private.length;
                        privateBellCount.classList.remove('hidden');
                        privateBellCount.classList.add('flex');
                        privateNotifications = res.data.private;
                    } else {
                        privateBellCount.innerText = '';
                        privateBellCount.classList.remove('flex');
                        privateBellCount.classList.add('hidden');
                        privateNotifications = [];
                    }

                    buildContent('#public_titles', publicNotifications);
                    buildContent('#private_titles', privateNotifications);
                });
        };

        const markRead = (ids) => {
            axios.post();
        };

        const buildContent = (id, notifications) => {
            const container = document.querySelector(id);
            container.innerHTML = null;

            for (let i = 0; i < notifications.length; i++) {
                const notification = document.createElement('li');
                notification.innerText = notifications[i].title;
                container.append(notification);
            }
        };

        document.addEventListener('DOMContentLoaded', () => {
            setInterval(updateNotifications, 1000);
        });

        publicBell.addEventListener('click', () => {
            // buildContent('#public_titles', []);
            const ids = publicNotifications.map(notification => notification.id);
            axios.post('{{route('polling.js.store')}}', {ids});
        });

        privateBell.addEventListener('click', () => {
            // buildContent('#private_titles', []);
            const ids = privateNotifications.map(notification => notification.id);
            axios.post('{{route('polling.js.store')}}', {ids});
        });
    </script>
</x-app-layout>
