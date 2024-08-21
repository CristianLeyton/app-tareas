<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    <style>
        :root {
            --checkBox: #4f46e5;

            --btnPrimary: #6366f1;
            --btnPrimaryHover: #818cf8;

            --btnEdit: #1f2937;
            --btnEditHover: #374151;
            --btnDelete: #dc2626;
            --btnDeleteHover: #ef4444;

            --color-terciary: #f9fafb;
        }

        .dia49 {
            min-height: 90dvh;
            box-shadow: 0 3px 5px #ddd;
            border-radius: 12px;
            padding: 1rem;
            background-color: #ffffff;
        }

        .dia49 header {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 10px;
        }

        .dia49 .btnPrimary,
        .dia49 .btnSecondary,
        .dia49 .btnDelete {
            display: flex;
            width: fit-content;
            padding-inline: 16px;
            padding-block: 8px;
            text-transform: uppercase;
            font-size: small;
            align-items: center;
            border-radius: 8px;
            gap: 6px;
            letter-spacing: 1px;
            transition:
                background 0.2s ease-in-out,
                outline 0.08s ease-in-out;
        }

        .btnPrimary {
            background-color: var(--btnPrimary);
            color: #ffffff;

            &:hover {
                background-color: var(--btnPrimaryHover);
            }

            &:active {
                outline: 2px solid var(--btnPrimary);
                outline-offset: 2px;
            }

            & span {
                width: 20px;
                height: 20px;
            }
        }

        .btnSecondary {
            background-color: #ffffff;
            border: 1px solid #ccc;
            outline: transparent;

            &:hover {
                background-color: var(--color-terciary);
            }

            &:active {
                outline: 2px solid var(--btnPrimary);
                outline-offset: 2px;
            }

            & span {
                width: 20px;
                height: 20px;
            }
        }

        .btnDelete {
            background-color: var(--btnDelete);
            color: #ffffff;

            &:hover {
                background-color: var(--btnDeleteHover);
            }

            &:active {
                outline: 2px solid var(--btnDelete);
                outline-offset: 2px;
            }
        }

        .filters {
            display: flex;
            flex-wrap: nowrap;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
            font-size: small;
            font-weight: 500;

            & label {
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
                align-items: center;
                gap: 8px;
            }

            & select {
                border: 1px solid #ccc;
                border-radius: 6px;
                display: flex;
                color: #7e7e7e;
                outline: transparent;

                &:focus {
                    outline: 2px solid var(--btnPrimary);
                    outline-offset: -1px;
                }
            }
        }

        .firstColMobile {
            display: none;
        }

        .dia49 table {
            width: 100%;
            border-radius: 10px;
            margin-top: 8px;
            box-shadow: 0 2px 6px #eee;
            overflow: hidden;
        }

        .dia49 thead tr {
            display: flex;
            width: 100%;
            align-items: center;
            justify-content: space-between;
            background-color: var(--color-terciary);
            padding: 1rem;

            & th {
                width: 100%;
                text-transform: uppercase;
                font-size: small;


                &:first-child {
                    flex: 0;
                    /* border: 1px solid red;  */
                }

                &:nth-child(2) {
                    flex: 2;
                    text-align: left;
                    padding-left: 3rem;
                }

                &:nth-child(3) {
                    flex: 1;
                    text-align: left;
                }

                &:last-child {
                    /* border: 1px solid red;  */
                    flex: 1.5;
                }
            }
        }

        .dia49 tbody tr {
            background-color: var(--color-terciary);
            display: flex;
            align-items: center;
            width: 100%;
            justify-content: center;
            padding: 1rem;
            background-color: white;
            border-bottom: 1px solid #e2e2e2;

            &:hover {
                background-color: var(--color-terciary);
            }

            & td {
                width: 100%;
                font-size: small;
                font-weight: 500;

                &:first-child {
                    padding-left: 2rem;
                    flex: 0;
                }

                &:nth-child(2) {
                    flex: 2;
                    text-align: left;
                    overflow: hidden;
                    text-wrap: nowrap;
                    text-overflow: ellipsis;
                    padding-left: 5rem;

                    &::first-letter {
                        text-transform: capitalize;
                    }
                }

                &:nth-child(3) {
                    flex: 1;
                    display: flex;
                    flex-wrap: nowrap;
                    gap: 6px;

                    & span {
                        display: flex;
                        flex-wrap: nowrap;
                        align-items: center;

                        & svg {
                            width: 16px;
                        }
                    }
                }

                &:last-child {
                    /* border: 1px solid red;  */
                    flex: 1.5;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    gap: 3px;
                }
            }
        }

        .tagImportant {
            color: #dc2626;
        }

        .tagOpcional {
            color: var(--checkBox);
        }

        .checkboxCompleted {
            display: flex;
            width: 24px;
            color: transparent;
            background-color: var(--color-terciary);
            border-radius: 4px;
            border: 1px solid #7e7e7e;
            width: 24px;
            height: 24px;
            transition:
                color 0.1s ease-in-out,
                outline 0.1s cubic-bezier(0.4, 0, 0.2, 1);

            &:hover {
                outline: 2px solid var(--checkBox);
                outline-offset: 2px;
            }

            &:active {
                color: var(--checkBox);
            }

            & i {
                width: 100%;
                height: 100%;
                transform: scale(1.45);
            }
        }

        .dia49 .noteCompleted {
            & td {
                opacity: 0.7;

                &:first-child .checkboxCompleted {
                    color: var(--checkBox);
                }

                &:nth-child(2) {
                    text-decoration: line-through;
                }
            }
        }

        .btnAction {
            color: white;
            padding: 4px 10px;
            border-radius: 6px;
            transition: outline 0.1s cubic-bezier(0.4, 0, 0.2, 1);

            & svg {
                width: 18px;
                height: 18px;
            }
        }

        .details {
            border: 1px solid #ccc;
            background-color: white;
            color: #7e7e7e;

            &:hover {
                background-color: var(--color-terciary);
            }

            &:active {
                z-index: 2;
                background-color: white;
                outline: 2px solid var(--btnPrimary);
                outline-offset: 2px;
            }
        }

        .edit {
            background-color: var(--btnEdit);

            &:hover {
                background-color: var(--btnEditHover);
            }

            &:active {
                z-index: 2;
                background-color: var(--btnEdit);
                outline: 2px solid var(--btnEdit);
                outline-offset: 2px;
            }
        }

        .delete {
            background-color: var(--btnDelete);

            &:hover {
                background-color: var(--btnDeleteHover);
            }

            &:active {
                z-index: 2;
                background-color: var(--btnDelete);
                outline: 2px solid var(--btnDelete);
                outline-offset: 2px;
            }
        }

        .dia49 #newTaskModal,
        .dia49 #viewDetailsModal,
        .dia49 #deleteTaskModal,
        .dia49 #editTaskModal {
            border-radius: 10px;
            box-shadow: 0 3px 5px #7a7a7a;
            overflow: hidden;

            & footer {
                margin: 0;
                background-color: #f3f4f6;
                padding: 0.8rem 1.5rem;
                display: flex;
                align-items: center;
                justify-content: end;
                gap: 10px;
            }
        }

        .dia49 #newTaskModal::backdrop,
        .dia49 #viewDetailsModal::backdrop,
        .dia49 #deleteTaskModal::backdrop,
        .dia49 #editTaskModal::backdrop {
            background-color: #44444490;
        }

        .dia49 .createNewTask,
        .dia49 .viewTask,
        .dia49 .deleteTask,
        .dia49 .editTask {
            margin: 1rem 1.5rem;
            display: flex;
            flex-direction: column;
            gap: 1rem;
            width: 675px;

            & input,
            & textarea {
                border: 1px solid #eee;
                outline: transparent;
                border-radius: 4px;
                accent-color: #4f46e5;

                &:focus {
                    outline: 2px solid var(--checkBox);
                    outline-offset: -1px;
                }
            }

            & header {
                color: #4f46e5;
                font-weight: 600;
                font-size: large;
            }

            & form {
                display: flex;
                flex-direction: column;
                gap: 1rem;

                & .input {
                    display: flex;
                    flex-direction: column;

                    font-size: 14px;
                }

                & .inputTags {
                    display: flex;
                    gap: 5px;
                    align-items: center;
                    font-size: 14px;
                }

                & .inputCheckbox {
                    border: 1px solid #eee;
                    padding: 3px 6px;
                    border-radius: 6px;
                    display: flex;
                    flex-wrap: nowrap;
                    width: fit-content;
                    font-size: small;
                    align-items: center;

                    & span {
                        transform: scale(0.7);
                    }
                }
            }
        }

        .viewTask {
            font-size: 14px;

            & .taskSpan {
                color: var(--btnPrimary);
            }
        }

        .viewTagsTask {
            display: flex;
            align-items: center;

            & div {
                font-size: small;
            }

            & span {
                transform: scale(0.7);
            }
        }

        .deleteTask {
            & header {
                display: flex;
                justify-content: start;
                align-items: center;
                color: var(--btnDelete) !important;

                & i {
                    background-color: #fee2e2;
                    padding: 7px 10px 10px 10px;
                    border-radius: 50%;
                }
            }

            & p {
                font-size: 14px;
                text-wrap: pretty;
            }
        }

        @media (max-width: 639px) {
            .dia49 {
                border-radius: 0;
                box-shadow: none;
                padding: 1rem 1rem;
            }

            .filters {
                width: 100%;

                & label {
                    display: flex;
                    flex-direction: column;
                    align-items: start;
                }
            }

            .firstCol {
                display: none;
            }

            .firstColMobile {
                display: block;
                color: var(--checkBox);
                width: 24px;
                height: 24px;
                outline: 1px solid var(--checkBox);
                border-radius: 4px;

                & svg {
                    transform: scale(1.4);
                }
            }

            .dia49 thead tr {
                & th {
                    &:nth-child(2) {
                        flex: 2;
                        text-align: left;
                        padding-left: 1.5rem;
                    }

                    &:nth-child(3) {
                        display: none;
                    }
                }
            }

            .dia49 tbody tr {
                & td {
                    &:first-child {
                        padding-left: 0;
                        flex: 0;
                    }

                    &:nth-child(2) {
                        padding-left: 1.5rem;
                    }

                    &:nth-child(3) {
                        display: none;
                    }
                }
            }

            .dia49 .createNewTask,
            .dia49 .viewTask,
            .dia49 .deleteTask,
            .dia49 .editTask {
                width: 300px;
            }
        }
    </style>
    @livewireStyles
</head>

<body>


    <div class="text-gray-900 antialiased">
        {{ $slot }}
    </div>

    @livewireScripts
</body>

</html>
