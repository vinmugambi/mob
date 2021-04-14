<template>
    <app-layout>
        <template #header>
            <h1 class="mx-auto max-w-xl text-3xl">Edit {{ event.title }}</h1>
        </template>
        <form @submit.prevent="create" class="mx-auto max-w-xl">
            <div class="text-red-500" v-if="Object.keys(errors).length > 0">
                <p
                    class="sm"
                    v-for="(value, name) in errors"
                    :key="`create-error-${name}`"
                >
                    {{ value }}
                </p>
            </div>
            <form-factory
                :value="eventToUpdate"
                @update="update($event)"
                :schema="formSchema"
            ></form-factory>
            <jet-button type="submit">Submit changes</jet-button>
        </form>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import JetValidationErrors from "@/Jetstream/ValidationErrors";
import FormFactory from "../../form/FormFactory";
import JetButton from "./../../Jetstream/Button";
import { Inertia } from "@inertiajs/inertia";

export default {
    props: ["errors", "event"],
    components: {
        AppLayout,
        JetValidationErrors,
        FormFactory,
        JetButton,
    },

    data() {
        return {
            formSchema: {
                title: {
                    label: "Title",
                    component: "text",
                    model: "title",
                },
                start_time: {
                    label: "Time event starts",
                    component: "date",
                    model: "start_time",
                    attrs: {
                        min: new Date(),
                        max: null,
                    },
                },
                end_time: {
                    label: "When the event ends",
                    component: "date",
                    model: "end_time",
                    attrs: {
                        min: new Date(),
                        max: null,
                    },
                },
                description: {
                    label: "Description",
                    component: "textarea",
                    model: "description",
                },
                image: {
                    label: "Image",
                    component: "file",
                    model: "image",
                },
                address: {
                    label: "Venue",
                    component: "text",
                    model: "address",
                },
                city: {
                    label: "City",
                    model: "city",
                    component: "text",
                },
            },
        };
    },
    computed: {
        eventToUpdate() {
            return {
                ...this.event,
                start_time: new Date(this.event.start_time),
                end_time: new Date(this.event.end_time),
            };
        },
    },
    methods: {
        safeId(field) {
            return field.model.replace(/\s+/g, "-");
        },
        update(field) {
            let key = Object.keys(field)[0];
            this.eventToUpdate[key] = field[key];
        },
        create() {
            var newEvent = this.eventToUpdate;
            var oldEvent = this.event;

            // remove unchanged fields from patch data
            var eventFields = Object.keys(this.event);
            eventFields.forEach(function (key) {
                if (newEvent[key] && newEvent[key] === oldEvent[key]) {
                    delete newEvent[key];
                }
            });

            // use patch not put
            Inertia.post(
                `/event/${this.event.id}`,
                {
                    ...newEvent,
                    _method: "patch",
                },
                {
                    forceFormData: true,
                }
            );
        },
    },
};
</script>
