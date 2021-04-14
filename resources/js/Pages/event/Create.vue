<template>
    <app-layout>
        <template #header>
            <h1 class="mx-auto max-w-xl text-3xl">Create a new event</h1>
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
            event: {
                title: "",
                description: "",
                image: "",
                start_time: null,
                end_time: null,
                city: "",
                address: "",
            },
        };
    },
    watch: {
        start_time: function (val) {
            if (!this.end_time || new Date(this.end_time).getTime() < new Date(val).getTime()) {
                this.end_time = new Date(val) + (15*60*1000);
            }
            this.formSchema.end_time.min = val;

            console.log(this.end_time, this.formSchema.end_time.min);
        },
        end_time: function (val) {
            if (!this.start_time || new Date(this.starttime).getTime() > new Date(val).getTime()) {
                this.start_time = new Date(val) - (15*60*1000);
            }
            this.formSchema.start_time.max = val;
        },
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
