<template>
    <app-layout>
        <template #header>
            <div class="mx-auto max-w-6xl">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="col-span-2">
                        <img
                            class="w-full object-cover"
                            :src="event.image"
                            :alt="'banner image for ' + event.title + ' events'"
                        />
                    </div>
                    <div class="flex flex-col pt-2 pb-4">
                        <h1 class="text-2xl font-bold">{{ event.title }}</h1>
                        <div class="text-gray-600">
                            <div>
                                Hosted by
                                <strong class="capitalize">{{
                                    owner.name
                                }}</strong>
                            </div>
                            <a
                                href="#bookings"
                                class="hover:underline"
                                v-if="
                                    userIsOwner && numberOfBookingsForThisEvent
                                "
                            >
                                {{ numberOfBookingsForThisEvent }}
                                {{
                                    numberOfBookingsForThisEvent > 1
                                        ? "people have"
                                        : "person has"
                                }}
                                booked this event.
                            </a>
                            <div
                                v-else-if="
                                    numberOfBookingsForThisEvent && !booking
                                "
                            >
                                {{ numberOfBookingsForThisEvent }}
                                {{
                                    numberOfBookingsForThisEvent > 1
                                        ? "people have"
                                        : "person has"
                                }}
                                booked this event.
                            </div>
                            <div
                                v-else-if="
                                    numberOfBookingsForThisEvent === 1 &&
                                    booking
                                "
                            >
                                You have booked this event
                            </div>
                            <div
                                v-else-if="
                                    numberOfBookingsForThisEvent > 1 && booking
                                "
                            >
                                You and {{ numberOfBookingsForThisEvent-1 }} other
                                {{
                                    numberOfBookingsForThisEvent > 2
                                        ? "people have"
                                        : "person have"
                                }}
                                booked this event.
                            </div>
                        </div>
                        <div class="pt-8 flex items-center">
                            <div class="pr-4 uppercase text-4xl">
                                {{ formatDate(event.start_time) }}
                            </div>
                            <div class="pl-6 border-l">
                                <div>Starts at {{ startTime }}</div>
                                <div>
                                    Lasts {{ eventDuration }}
                                    {{ eventDuration > 1 ? "hours" : "hour" }}
                                </div>
                            </div>
                        </div>
                        <div class="pt-4">
                            {{ event.address }}, &Tab; {{ event.city }}
                        </div>
                        <div class="mt-auto">
                            <div v-if="+event.user_id !== user.id">
                                <button
                                    @click="cancelBooking(booking.id)"
                                    type="button"
                                    v-if="booking"
                                    class="inline-flex items-center mt-auto px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition"
                                >
                                    Cancel booking
                                </button>
                                <button
                                    @click="book"
                                    type="button"
                                    v-else
                                    class="inline-flex items-center mt-auto px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition"
                                >
                                    Book this event
                                </button>
                            </div>
                            <div v-else>
                                <a
                                    :href="'/event/' + event.id + '/edit'"
                                    class="inline-flex items-center mr-2 px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition"
                                    >Edit</a
                                >
                                <button
                                    type="button"
                                    @click="delete event.id"
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
            <section class="pb-6">
                <h2 class="text-xl font-bold">About</h2>
                <p>{{ event.description }}</p>
            </section>
            <section v-if="userIsOwner">
                <h2 class="text-xl font-bold pb-4" id="bookings">
                    People who have booked this event
                </h2>

                <ul>
                    <li
                        v-for="booking in bookings"
                        :key="'booking' + booking.id"
                        class="border-b border-gray-100 py-2"
                    >
                        <strong class="capitalize"
                            >{{ booking.user.name }}
                        </strong>
                        made a booking on {{ formatDate(booking.created_at) }}
                    </li>
                </ul>
            </section>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import { Inertia } from "@inertiajs/inertia";
import { formatDate } from "./../../utils.js";

export default {
    components: { AppLayout },
    props: ["event", "user", "booking", "owner", "bookings"],
    computed: {
        numberOfBookingsForThisEvent() {
            return typeof this.bookings === "number"
                ? this.bookings
                : this.bookings.length;
        },
        userIsOwner() {
            return this.owner.id === this.user.id;
        },
        eventDuration() {
            var hours =
                (new Date(this.event.end_time).getTime() -
                    new Date(this.event.start_time).getTime()) /
                3600000;
            return Math.abs(Math.round(hours));
        },
        startTime() {
            return new Date(this.event.start_time).toLocaleTimeString("en-GB", {
                hour: "2-digit",
                minute: "2-digit",
            });
        },
    },
    methods: {
        delete(id) {
            Inertia.delete(`/event/${id}`);
        },
        book() {
            Inertia.post("/booking", { id: this.event.id });
        },
        cancelBooking($id) {
            Inertia.delete(`/booking/${id}`);
        },
        formatDate(date) {
            return formatDate(date);
        },
    },
};
</script>
