<template>
    <light-layout>
        <template #content>
            <div>
                <div v-if="$page.props.jetstream.canUpdateProfileInformation">
                    <update-profile-information-form :user="$page.props.user" />
                    <div class="h-8" />
                </div>

                <section-border />

                <div v-if="$page.props.jetstream.canUpdatePassword">
                    <update-password-form />
                    <div class="h-8" />
                </div>

                <section-border />

                <div v-if="$page.props.jetstream.canManageTwoFactorAuthentication">
                    <two-factor-authentication-form />
                    <div class="h-8" />
                </div>

                <section-border />

                <logout-other-browser-sessions-form :sessions="sessions" class="mt-10 sm:mt-0" />

                <section-border />

                <template v-if="$page.props.jetstream.hasAccountDeletionFeatures">
                    <div class="h-8" />

                    <delete-user-form />
                </template>
            </div>
        </template>
    </light-layout>
</template>

<script>
    import LightLayout from '@/Layouts/LightLayout'
    import DeleteUserForm from './DeleteUserForm'
    import JetSectionBorder from '@/Jetstream/SectionBorder'
    import LogoutOtherBrowserSessionsForm from './LogoutOtherBrowserSessionsForm'
    import TwoFactorAuthenticationForm from './TwoFactorAuthenticationForm'
    import UpdatePasswordForm from './UpdatePasswordForm'
    import UpdateProfileInformationForm from './UpdateProfileInformationForm';
    import SectionBorder from "../../Jetstream/SectionBorder";

    export default {
        props: ['sessions'],

        components: {
            SectionBorder,
            LightLayout,
            DeleteUserForm,
            JetSectionBorder,
            LogoutOtherBrowserSessionsForm,
            TwoFactorAuthenticationForm,
            UpdatePasswordForm,
            UpdateProfileInformationForm,
        },
    }
</script>
