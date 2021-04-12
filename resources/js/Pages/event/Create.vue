<template>
    <app-layout>
        <template #header>
            <h1 class="mx-auto max-w-xl text-3xl">Create a new event</h1>
        </template>
        <form @submit.prevent="create" class="mx-auto max-w-xl">
            <pre>
             {{ errors }}
         </pre
            >
            <form-factory
                :value="event"
                @update="update($event)"
                :schema="formSchema"
            ></form-factory>
            <jet-button type="submit">Create</jet-button>
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
    props: ["errors"],
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
                },
                end_time: {
                    label: "When the event ends",
                    component: "date",
                    model: "end_time",
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
            event: {
                title: "",
                description: "",
                image: "",
                start_time: new Date(),
                end_time: new Date(),
                city: "",
                address: "",
            },
        };
    },
    methods: {
        safeId(field) {
            return field.model.replace(/\s+/g, "-");
        },
        update(field) {
            let key = Object.keys(field)[0];
            this.event[key] = field[key];
        },
        create() {
            Inertia.post(
                "/event",
                {
                    ...this.event,
                    _method: "post",
                },
                {
                    forceFormData: true,
                }
            );
        },
    },
};
</script>
