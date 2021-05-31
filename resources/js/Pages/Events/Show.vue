<template>
    <app-layout>
        <template #content>
            <span class="block mb-5 text-xl text-gray-500 text-center">Events</span>

            <div class="flex items-center mb-5">
                <div class="w-full relative flex items-center">
                    <jet-input @keydown="handleKeyDown" v-model="searchQuery" type="text" name="search" placeholder="Search event" class="w-full" />
                    <svg
                        @click="clearSearchInput"
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 cursor-pointer absolute text-gray-500 right-10 bottom-3"
                        viewBox="0 0 20 20"
                        fill="currentColor">
                        <path
                            fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                            clip-rule="evenodd" />
                    </svg>
                    <svg @click="searchForEvent" xmlns="http://www.w3.org/2000/svg" class="h-5 cursor-pointer bottom-3 absolute right-2 text-gray-500 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>

                <div class="w-8" />

                <div class="w-full relative">
                    <flat-pickr
                        :config="flatPickrConfig"
                        class="border-gray-300 cursor-pointer w-full focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50 rounded-md shadow-sm"
                        placeholder="Search by date"
                        name="spec_date"
                        ref="specDate"
                        v-model="searchDate"
                        @on-change="onDateInputChange"
                    />
                    <svg
                        @click="clearCalendarInput"
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 cursor-pointer absolute text-gray-500 right-10 bottom-3"
                        viewBox="0 0 20 20"
                        fill="currentColor">
                        <path
                            fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                            clip-rule="evenodd" />
                    </svg>
                    <svg
                        @click="openCalendar"
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6 cursor-pointer absolute text-gray-500 right-2 bottom-3"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
            </div>


            <div v-for="event in events" :key="event.id" class="mb-3 rounded-lg shadow h-24 text-white bg-gray-700 px-2">
                <div class="flex items-center justify-between h-full px-2">
                    <div>
                        <span class="font-semibold text-green-400">{{ event.title }}</span>
                        <p class="text-xs w-56">{{ getReducedDescription(event.description) }}</p>
                    </div>

                    <div>
                        <span v-if="event.spec_date !== null">{{ getFormattedDate(event.spec_date) }} | {{ getFormattedTime(event.spec_time) }}</span>
                        <span v-else>Daily</span>
                    </div>

                    <div class="flex items-end">
                        <span @click="openEditModal(event)" class="flex flex-col cursor-pointer hover:text-green-400 items-center mx-5">
                             <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                            </svg>
                            <p class="text-xs">Edit Event</p>
                        </span>
                        <span @click="openDeleteEventModal(event.id)" class="flex flex-col items-center cursor-pointer hover:text-green-400">
                             <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                                <path fillRule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clipRule="evenodd" />
                            </svg>
                            <p class="text-xs">Delete Event</p>
                        </span>
                    </div>
                </div>
            </div>
                <!-- Edit Event Modal -->
                <jet-dialog-modal :show="showEditModal" @close="closeEditModal">
                    <template #title>Edit Event</template>

                    <template #content>
                        <div class="col-span-6">
                            <jet-label for="title" value="Title" />
                            <jet-input id="title" type="text" class="block w-full mt-1" v-model="form.title" autocomplete="title" />
                            <jet-input-error :message="form.errors.title" class="mt-2" />
                        </div>

                        <div class="col-span-6 mt-5">
                            <jet-label for="description" value="Description" />
                            <textarea
                                class="w-full mt-2 border-gray-300 rounded-md shadow-sm focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50"
                                name="description"
                                id="description"
                                v-model="form.description"
                                rows="6"></textarea>
                            <jet-input-error :message="form.errors.description" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-between col-span-6 mt-5">
                            <div class="flex items-center text-sm font-medium text-gray-700">
                                Daily <jet-checkbox :checked="checkBoxChecked(form.daily)" v-model="form.daily" class="ml-2" />
                            </div>
                            <div v-if="!form.daily" class="flex items-center text-sm font-medium text-gray-700">
                                Remind Before <jet-checkbox :checked="showRemindOptions" v-model="showRemindOptions" class="ml-2" />
                            </div>
                            <div class="flex items-center text-sm font-medium text-gray-700">
                                Email<jet-checkbox :checked="checkBoxChecked(form.push_email)" v-model="form.push_email" class="ml-2" />
                            </div>
                            <div class="flex items-center text-sm font-medium text-gray-700">
                                Important<jet-checkbox :checked="checkBoxChecked(form.important)" v-model="form.important" class="ml-2" />
                            </div>
                        </div>

                        <div v-if="!form.daily" class="relative grid grid-cols-2 col-span-6 gap-8 mt-5">
                            <div class="relative w-full">
                                <flat-pickr
                                    v-model="form.spec_date"
                                    :config="flatPickrConfig"
                                    class="w-full border-gray-300 rounded-md shadow-sm cursor-pointer focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50"
                                    placeholder="Specify date"
                                    name="spec_date"
                                    ref="specDate"
                                />
                                <svg
                                    @click="clearCalendarInput"
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="absolute w-5 h-5 text-gray-500 cursor-pointer right-10 bottom-3"
                                    viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path
                                        fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                        clip-rule="evenodd" />
                                </svg>

                                <svg
                                    @click="openCalendarOnIconClick"
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="absolute w-6 h-6 text-gray-500 cursor-pointer right-2 bottom-3"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div class="relative w-full">
                                <flat-pickr
                                    v-model="form.spec_time"
                                    :config="flatPickrConfigTime"
                                    class="w-full border-gray-300 rounded-md shadow-sm cursor-pointer focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50"
                                    placeholder="Specify time"
                                    name="spec_time"
                                    ref="specTime"
                                />

                                <svg
                                    @click="clearTimeInput"
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="absolute w-5 h-5 text-gray-500 cursor-pointer right-10 bottom-3"
                                    viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path
                                        fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                        clip-rule="evenodd" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="absolute w-6 h-6 text-gray-500 cursor-pointer right-2 bottom-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>

                        <div v-if="showRemindOptions" class="grid grid-cols-2 col-span-6 gap-8 mt-5">
                            <select
                                v-model="form.remind_before_option"
                                class="w-full text-gray-500 border-gray-300 rounded-md shadow-sm appearance-none cursor-pointer focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                                <option>Remind me before</option>
                                <option value="minutes">Minutes</option>
                                <option value="hours">Hours</option>
                                <option value="days">Days</option>
                                <option value="weeks">Weeks</option>
                                <option value="months">Months</option>
                            </select>

                            <jet-input
                                type="number"
                                class="w-full ml-2"
                                v-model="form.remind_before_value"
                                :placeholder="getBeforeValuePlaceholder()"
                                v-if="form.remind_before_option === 'minutes' || form.remind_before_option === 'hours' || form.remind_before_option === 'days' || form.remind_before_option === 'weeks' || form.remind_before_option === 'months'"
                            />
                        </div>
                    </template>

                    <template #footer>
                        <jet-secondary-button @click="closeEditModal">Cancel</jet-secondary-button>
                        <jet-button class="ml-3" @click="updateEvent">Save</jet-button>
                    </template>
                </jet-dialog-modal>
                <!-- Edit Event Modal -->

                <!-- Delete Event Modal -->
                <jet-confirmation-modal v-if="showDeleteModal" :show="showDeleteModal" @close="closeDeleteEventModal">

                    <template #title>Delete Event</template>
                    <template #content>Are you sure you want to delete this event?</template>

                    <template #footer>
                        <jet-secondary-button @click="closeDeleteEventModal">Cancel</jet-secondary-button>
                        <jet-danger-button @click="deleteEvent" class="ml-3">Confirm</jet-danger-button>
                    </template>

                </jet-confirmation-modal> 
                <!-- Delete Event Modal -->
            
        </template>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import JetCheckbox from '@/Jetstream/Checkbox';
import JetInput from '@/Jetstream/Input';
import JetConfirmationModal from '@/Jetstream/ConfirmationModal';
import JetDangerButton from '@/Jetstream/DangerButton';
import JetSecondaryButton from '@/Jetstream/SecondaryButton';
import JetDialogModal from '@/Jetstream/DialogModal';
import JetButton from '@/Jetstream/Button';
import JetLabel from '@/Jetstream/Label';
import moment from 'moment';
import _ from 'lodash';
import flatPickr from 'vue-flatpickr-component';

export default {
    components: {
        AppLayout,
        JetCheckbox,
        JetInput,
        JetConfirmationModal,
        JetDangerButton,
        JetSecondaryButton,
        flatPickr,
        JetDialogModal,
        JetButton,
        JetLabel
    },
    data() {
      return {
          searchQuery: "",
          searchDate: "",
          showDeleteModal: false,
          showEditModal: false,
          eventToDeleteId: null,
          eventToEdit: null,
          showRemindOptions: false,
          flatPickrConfig: {
              altFormat: 'M j, Y',
              altInput: true,
              dateFormat: 'Y-m-d',
          },
          flatPickrConfigTime: {
              enableTime: true,
              noCalendar: true,
              dateFormat: "H:i",
          },
          form: this.$inertia.form({
              title: "",
              description: "",
              daily: false,
              important: false,
              push_email: false,
              spec_date: "",
              spec_time: "",
              remind_before_value: "",
              remind_before_option: "Remind me before"
          })
      }
    },
    props: {
        events: Array
    },
    methods: {
        searchForEvent: _.debounce(function() {
            this.$inertia.visit(route('events.show', { search: this.searchQuery, date: this.searchDate }), {
                _method: 'GET',
                preserveState: true,
                preserveScroll: true,
                onSuccess: (value) => {}
            })
        }, 400),
        handleKeyDown(event) {
            if (event.key === 'Enter') {
                this.searchForEvent();
            }
        },
        deleteEvent() {
            this.showDeleteModal = false;
            this.$inertia.delete(route("events.delete", { eventId: this.eventToDeleteId }, {
                
            }));
        },
        openDeleteEventModal(eventId) {
            this.eventToDeleteId = eventId;
            this.showDeleteModal = true;
        },
        closeDeleteEventModal() {
            this.showDeleteModal = false;
        },
        getFormattedDate(date) {
            return  moment(date).format('dddd, MMMM Do YYYY')
        },
        getFormattedTime(time) {
            return time ? moment(time,'h:mm:ss').format('HH:mm A') : "";
        },
        getReducedDescription(text) {
            if (text.length > 80) {
                return text.substr(0, 80) + " ..."
            } else {
                return text
            }
        },
        onDateInputChange() {
            this.searchForEvent();
            this.closeCalendar();
        },
        openCalendar() {
            this.$refs.specDate.fp.open();
        },
        closeCalendar() {
            this.$refs.specDate.fp.close();
        },
        clearCalendarInput() {
            this.searchDate = "";
        },
        clearSearchInput() {
            this.searchQuery = "";
        },
        openEditModal(event) {
            this.showRemindOptions = false;
            this.form.remind_before_option = "Remind me before";
            this.eventToEdit = event;
            this.form.title = event.title;
            this.form.description = event.description;
            this.form.daily = event.daily;
            this.form.important = event.important;
            this.form.push_email = event.push_email;
            this.form.spec_date = event.spec_date;
            this.form.spec_time = event.spec_time;
            if (event.remind_before_option && event.remind_before_value) {
                this.form.remind_before_value = event.remind_before_value;
                this.form.remind_before_option = event.remind_before_option;
                this.showRemindOptions = true;
            }
            this.showEditModal = true;
        },
        closeEditModal() {
            this.showEditModal = false;
        },
        openCalendarOnIconClick() {
            this.$refs.specDate.fp.toggle();
        },
        updateEvent() {
            if (!this.showRemindOptions) {
                this.form.remind_before_value = null;
                this.form.remind_before_option = null;
            }
            this.form.put(route('events.update', { eventId: this.eventToEdit.id }), {
                onSuccess: () => {
                    this.showEditModal = false;
                }
            });
        },
        getBeforeValuePlaceholder() {
            switch (this.form.remind_before_option) {
                case "minutes":
                    return "Specify minutes"
                case "hours":
                    return "Specify hours"
                case "days":
                    return "Specify days"
                case "weeks":
                    return "Specify weeks"
                case "months":
                    return "Specify months"
            }
        },
        checkBoxChecked(value) {
            return value === 1;
        },
    },
    computed: {
        daily() {
            return this.form.daily
        }
    },
    watch: {
        searchQuery(value) {
            this.searchForEvent();
        },
        daily(value) {
            if (value === true) {
                this.showRemindOptions = false;
            }
        }
    },
}
</script>
