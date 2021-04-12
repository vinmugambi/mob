<template>
    <label class="block text-sm font-semibold" :for="inputId">{{label}} </label>
</template>

<script>
export default {
    props:{
        inputId: {type: String, required:true},
        label: {type:String, required: true}
    }
}
</script>
