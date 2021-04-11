<template>
     <app-layout>
        <template #header>
            <h1>Edit {{event.title}}</h1>
        </template>
     </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";

export default {
    components: {AppLayout},
    props: ["event"]
};
</script>