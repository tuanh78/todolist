<template>
    <div id="app">
        <div class="container todo">
            <h1 class="todo__heading">
                <a href="#">ToDoList</a>
            </h1>

            <div class="todo-form">
                <div class="todo-form__input">
                    <input
                        type="text"
                        class="form-control"
                        v-model="newTodo"
                        placeholder="Nhập công việc cần làm của bạn"
                    />
                </div>

                <div class="todo-form__btn">
                    <button class="btn btn-outline-primary" @click="createToDo">
                        Thêm
                    </button>
                </div>
            </div>

            <div role="alert" class="alert alert-danger" v-if="errors.length">
                <span v-for="(err, index) in errors" :key="index">
                    {{ err }}
                </span>
                <hr />
            </div>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Tên công việc</th>
                        <th class="text-center">Trạng thái</th>
                        <th class="text-center">Tùy chọn</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(todo, index) in todolist" :key="index">
                        <th class="text-center">
                            {{ index }}
                        </th>
                        <td class="todo-name" v-if="!todo.isEdit">
                            {{ todo.name }}
                        </td>
                        <td v-if="todo.isEdit" class="input-update text-center">
                            <input
                                class="form-control"
                                type="text"
                                v-model="todo.name"
                            />
                        </td>
                        <td v-if="!todo.isEdit" class="text-center">
                            <input
                                type="checkbox"
                                v-model="todo.condition"
                                disabled
                            />
                        </td>
                        <td v-if="todo.isEdit" class="text-center">
                            <input type="checkbox" v-model="todo.condition" />
                        </td>
                        <td class="text-center">
                            <label
                                class="btn btn-outline-secondary"
                                v-if="!todo.isEdit"
                            >
                                Sửa
                                <input type="checkbox" v-model="todo.isEdit" />
                            </label>

                            <button
                                v-if="todo.isEdit"
                                class="btn btn-success"
                                @click="updateToDo(todo, index)"
                            >
                                Lưu
                            </button>

                            <button
                                class="btn btn-outline-danger"
                                @click="deleteToDo(todo, index)"
                            >
                                Xóa
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            newTodo: '',
            todoSelected: {},
            todolist: [],
            errors: []
        };
    },
    methods: {
        createToDo() {
            this.todolist.push({
                name: this.newTodo,
                status: false
            });
            this.newTodo = '';
        },
        deleteToDo(todo, index) {
            this.todolist.splice(index, 1);
        },
        updateToDo(todo, index) {
            todo.isEdit = false;
            this.todolist[index].name = todo.name;
            this.todolist[index].status = todo.status;
        },
        selecteTodo() {}
    }
};
</script>

<style lang="scss" scoped>
.todo {
    &-form {
        display: flex;
        justify-content: center;
        margin-bottom: 2rem;

        &__input {
            width: 70%;
            text-align: center;
            margin-right: 0.2rem;
            input {
                width: 100%;
                padding: 0.5rem 0.5rem;
            }
        }

        &__btn {
            width: 10%;
            button {
                width: 100%;
                height: 100%;
            }
        }
    }
    padding-top: 5rem;
    &__heading {
        font-size: 3rem;
        text-align: center;
        font-style: italic;
        margin-bottom: 2rem;
    }

    .table {
        margin: 0 auto;
        td,
        th {
            padding: 0;
            height: 70px;
            line-height: 70px;
        }
        thead {
            tr {
                th:first-child {
                    width: 10%;
                }
                th:nth-child(2) {
                    width: 60%;
                }
                th:nth-child(3) {
                    width: 10%;
                }
                th:last-child {
                    width: 20%;
                }
            }
        }

        tbody {
            tr {
                th:first-child {
                    width: 10%;
                }
                // td:nth-child(2) {
                //     width: 60%;
                // }
                td:nth-child(3) {
                    width: 10%;
                }
                td:last-child {
                    width: 20%;
                    label {
                        margin-bottom: 0;
                    }
                    input {
                        display: none;
                    }
                }

                .input-update {
                    display: flex;
                    align-items: center;
                    width: 100%;
                    input {
                        width: 100%;
                    }
                }
            }
        }
    }

    table {
        table-layout: fixed;
    }
    table th,
    table td {
        overflow: hidden;
    }
}
</style>
