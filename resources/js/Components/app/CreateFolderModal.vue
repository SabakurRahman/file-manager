<template>
    <Modal :show="modelValue" @show="onShow" @close="closeModal" max-width="sm">
        <div class="p-6">
            <h2 class="text-lg font-medium text-gray-900">
                Create New Folder
            </h2>

            <div class="mt-6">
                <InputLabel for="folderName" value="folderName" class="sr-only"/>

                <TextInput
                    type="text"
                    id="folderName"
                    ref="folderNameInput"
                    v-model="form.name"
                    class="mt-1 block w-full"
                    placeholder="Folder Name"
                    @keyup.enter="createFolder"
                />

                <InputError :message="form.errors.name" class="mt-2"/>
            </div>

            <div class="mt-6 flex justify-end">
                <SecondaryButton @click="closeModal"> Cancel</SecondaryButton>

                <PrimaryButton
                    class="ml-3"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                    @click="createFolder"
                >
                    Submit
                </PrimaryButton>
            </div>
        </div>
    </Modal>
</template>

<script setup>
import SecondaryButton from "@/Components/SecondaryButton.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";
import Modal from "@/Components/Modal.vue";
import {useForm} from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3'
import {nextTick, ref} from 'vue';
import PrimaryButton from "@/Components/PrimaryButton.vue";

const page = usePage()

const {modelValue} = defineProps({
    modelValue: Boolean
})
const emit = defineEmits(['update:modelValue'])

const folderNameInput = ref(null);

const form = useForm({
    name: '',
    parent_id: null
});

function onShow() {
    nextTick(() => folderNameInput.value.focus())
}

const createFolder = () => {
    form.parent_id = page.props.folder?.id;
    form.post(route('folder.create'), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => folderNameInput.value.focus(),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    emit('update:modelValue', false)

    form.reset();
};
</script>

<style scoped>

</style>
