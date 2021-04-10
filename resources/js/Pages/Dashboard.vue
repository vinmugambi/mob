<template>
    <app-layout>
        <template #header>
            <div class="mx-auto max-w-6xl">
                <div class="flex justify-between items-center">
                    <h2 class="text-3xl pb-4">Discover cool events</h2>
                    <button
                        type="button"
                        class="bg-indigo-500 px-4 py-2 text-white rounded-lg"
                    >
                        Create event
                    </button>
                </div>
                <ul class="">
                    <li
                        class="inline-block rounded-full font-semibold border-2 border-indigo-500 px-4 py1 mr-2"
                    >
                        All
                    </li>
                    <li
                        class="inline-block rounded-full font-semibold bg-gray-100 px-4 py1 mr-2 border-2 border-transparent"
                    >
                        Nairobi
                    </li>
                </ul>
            </div>
        </template>

        <div
            class="py-4 mx-auto max-w-6xl grid grid-cols-1 sm:grid-cols-3 md:grid-cols-4 gap-4"
        >
            <div
                class="pb-4 rounded-lg overflow-hidden hover:bg-gray-100"
                v-for="event in events"
                :key="`event-${event.id}`"
            >
                <div class="relative">
                    <img
                        :src="event.image"
                        class="w-full object-cover"
                        :alt="`Cover image of ${event.title}`"
                    />
                    <div
                        class="location absolute text-white bottom-0 left-0 right-0 px-2 text-sm"
                    >
                        <span>{{ event.address }}</span
                        >, &Tab; <span>{{ event.city }}</span>
                    </div>
                </div>
                <div class="px-2">
                    <p class="text-lg font-semibold">{{ event.title }}</p>

                    <div>
                        <span>{{ event.start_date }}</span>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";

export default {
    components: {
        AppLayout,
    },
    props: ["events"],
};
</script>

<style lang="css" scoped>
.location {
    backdrop-filter: blur(10px);
    background: #00000030;
}
</style>
