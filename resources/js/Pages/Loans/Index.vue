<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import BookForm from "@/Components/BookForm.vue";
import ModalContainer from "@/Components/ModalContainer.vue";
import LoanDataTable from "@/Components/LoanDataTable.vue";

import { Head } from "@inertiajs/vue3";

import { ref } from "vue";
import { provide } from "vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Book from "@/Components/Book.vue";

const modalIsOpen = ref(false);
const editing = ref(false);
const deleteModalIsOpen = ref(false);
const selectedBook = ref({});

const props = defineProps(["loans"]);

provide("modalIsOpen", modalIsOpen);

function toggleBookFormModal(value) {
    modalIsOpen.value = value;
    if (!value) {
        selectedBook.value = {};
    }
}

function openEditModal(book) {
    selectedBook.value = book;
    editing.value = true;
    toggleBookFormModal(true);
}

function openDeleteModal(book) {
    selectedBook.value = book;
    deleteModalIsOpen.value = true;
}
</script>

<template>
    <Head title="Book Loans" />
    <AuthenticatedLayout>
        <div class="relative z-0">
            <div v-if="$page.props.auth.user.isAdmin" class="">
                <div
                    class="flex w-full bg-gray-100 justify-start px-7 py-3 mt-7"
                >
                    <PrimaryButton @click="toggleBookFormModal(true)"
                        >Add Book</PrimaryButton
                    >
                </div>
            </div>

            <div class="">
                <LoanDataTable :loans="loans" />
            </div>

            <!-- <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
										<Book
														v-for="book in loans"
														:key="book.id"
														:book="book"
														@edit="openEditModal"
														@delete="openDeleteModal"
										/>
						</div> -->

            <ModalContainer
                v-if="$page.props.auth.user.isAdmin"
                id="book-form-modal"
                :show="modalIsOpen"
                @close="toggleBookFormModal(false)"
            >
                <BookForm :book="selectedBook" :editing="editing" />
            </ModalContainer>
        </div>
    </AuthenticatedLayout>
</template>
