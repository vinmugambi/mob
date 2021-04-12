<template>
    <app-layout>
        <template #header>
            <div class="mx-auto max-w-6xl">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="col-span-2">
                        <img
                            class="w-full object-cover"
                            :src="'/' + event.image"
                            :alt="'banner image for ' + event.title + ' events'"
                        />
                    </div>
                    <div class="flex flex-col pt-2 pb-4">
                        <h1 class="text-3xl">{{ event.title }}</h1>
                        <div class="mt-auto">
                            <button
                                @click="book"
                                type="button"
                                v-if="+event.user_id !== user.id"
                                class="inline-flex items-center mt-auto px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition"
                            >
                                Book this event
                            </button>
                            <div v-else>
                                <a
                                    :href="'/event/' + event.id + '/edit'"
                                    class="inline-flex items-center mr-2 px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition"
                                    >Edit</a
                                >
                                <button
                                    type="button"
                                    click="delete()"
                                    class="inline-flex items-center mt-auto px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-grey-800 uppercase tracking-widest hover:bg-red-200 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition"
                                >
                                    Delete
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </template>
        <div class="mx-auto max-w-6xl">
            <section>
                <h2 class="text-xl font-bold">About</h2>
                <p>{{ event.description }}</p>
            </section>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import { Inertia } from "@inertiajs/inertia";

export default {
    components: { AppLayout },
    props: ["event", "user"],
    methods: {
        delete() {},
        book() {
            Inertia.post("/booking", { id: this.event.id });
        },
    },
};
</script>
