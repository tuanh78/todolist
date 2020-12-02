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
                        v-model="todo.name"
                        placeholder="Nhập công việc cần làm của bạn"
                    />
                </div>

                <div class="todo-form__btn">
                    <button class="btn btn-outline-primary" @click="createToDo">
                        Thêm
                    </button>
                </div>
            </div>

            <div class="error" v-if="errors.length">
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
                        <th class="text-center">{{ todo.id }}</th>
                        <td class="text-center">
                            {{ todo.name }}
                        </td>
                        <td class="text-center">
                            {{ todo.condition }}
                        </td>
                        <td class="text-center">
                            <button @click="deleteToDo(todo, index)">
                                Xóa
                            </button>
                            <button @click="updateToDo">
                                Sửa
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
            todo: {
                name: "",
                state: false
            },
            todolist: [],
            errors: []
        };
    },
    methods: {
        createToDo() {
            axios
                .post("/todolist", {
                    name: this.todo.name,
                    state: this.todo.state
                })
                .then(response => {
                    this.todolist.push(response.data.todo);
                })
                .catch(error => {
                    this.errors = error.response.data.errors.name;
                });
        },
        getToDoList() {
            axios
                .get("/todolist")
                .then(response => {
                    this.todolist = response.data.todolist;
                })
                .catch(error => {
                    this.errors = error.response.data.errors.name;
                });
        },
        deleteToDo(todo, index) {
            axios
                .delete("/todolist/" + todo.id)
                .then(response => {
                    console.log(response.data.message);
                    this.todolist.splice(index, 1);
                })
                .catch(error => {
                    this.errors = error.response.data.errors.name;
                });
        },
        updateToDo(todo, index) {}
    },
    created() {
        this.getToDoList();
    },
    mounted() {
        console.log("Component mounted.");
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
                td:nth-child(2) {
                    width: 60%;
                }
                td:nth-child(3) {
                    width: 10%;
                }
                td:last-child {
                    width: 20%;
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
