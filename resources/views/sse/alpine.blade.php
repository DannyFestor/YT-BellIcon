<x-app-layout>
    <main x-data="Notifications" class="flex gap-16">
        <div>
            <div @click="() => markRead(publicNotificationIds)" class="relative w-6 h-6">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor"
                     class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0"/>
                </svg>
                <div x-show="publicNotificationCount > 0"
                     x-text="publicNotificationCount"
                     class="absolute top-0 right-0 translate-x-1/2 -translate-y-1/2 w-4 h-4 rounded-full bg-red-600 text-white flex justify-center items-center"></div>
            </div>
            <ol class="list-decimal">
                <template x-for="notification in publicNotifications" x-bind:key="notification.id">
                    <li x-text="notification.title"></li>
                </template>
            </ol>
        </div>

        <div>
            <div @click="() => markRead(privateNotificationIds)" class="relative w-6 h-6">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor"
                     class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0"/>
                </svg>
                <div x-show="privateNotificationCount > 0"
                     x-text="privateNotificationCount"
                     class="absolute top-0 right-0 translate-x-1/2 -translate-y-1/2 w-4 h-4 rounded-full bg-red-600 text-white flex justify-center items-center"></div>
            </div>
            <ol class="list-decimal">
                <template x-for="notification in privateNotifications" x-bind:key="notification.id">
                    <li x-text="notification.title"></li>
                </template>
            </ol>
        </div>
    </main>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('Notifications', () => ({
                publicNotifications: [],
                privateNotifications: [],

                get publicNotificationCount() {
                    return this.publicNotifications.length;
                },

                get publicNotificationIds() {
                    return this.publicNotifications.map(n => n.id);
                },

                get privateNotificationCount() {
                    return this.privateNotifications.length;
                },

                get privateNotificationIds() {
                    return this.privateNotifications.map(n => n.id);
                },

                async markRead(ids) {
                    const res = await axios.post('{{route('sse.alpine.store')}}', {ids});
                    console.log(res);
                },

                init() {
                    const es = new EventSource('{{ route('sse.alpine.show') }}');

                    es.addEventListener('message', event => {
                        let data = JSON.parse(event.data);
                        console.log(data);

                        if (data['public']) {
                            this.publicNotifications = data['public'];
                        }

                        if (data['private']) {
                            this.privateNotifications = data['private'];
                        }
                    }, false);

                    es.addEventListener('error', event => {
                        if (event.readyState === EventSource.CLOSED) {
                            console.log('Event was closed');
                            console.log(EventSource);
                        }
                    }, false);
                },
            }));
        });
    </script>
</x-app-layout>
