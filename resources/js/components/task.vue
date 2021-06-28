<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card" v-if="job == 'add' || job == 'edit'">
                    <div class="add">
                        <div class="row">
                            <div class="col-md-6">
                                <textarea
                                    v-model="task.name"
                                    placeholder="Enter Task Name"
                                ></textarea>
                            </div>
                            <div class="col-md-6">
                                <textarea
                                    v-model="task.project"
                                    placeholder="Enter Project Name"
                                ></textarea>
                            </div>
                        </div>

                        <button
                            type="button"
                            @click="save()"
                            v-if="job == 'add'"
                        >
                            Save
                        </button>
                        <button
                            type="button"
                            @click="update()"
                            v-if="job == 'edit'"
                        >
                            Update
                        </button>
                    </div>
                </div>
                <div class="card">
                    <button
                        @click="addMore()"
                        v-if="task != 'add' && task != 'edit'"
                    >
                        Add More
                    </button>
                    <button
                        @click="init()"
                        v-if="job == 'add' || job == 'edit'"
                    >
                        Cancel
                    </button>
                    <div class="card-header">Task Management</div>
                    <div class="row">
                        <select @change="filterByProject">
                            <option value="" disabled selected
                                >Filter by Project Name</option
                            >
                            <option value="1">Show All</option>
                            <option
                                :value="item"
                                v-for="(item, index) in projects"
                                :key="index"
                                >{{ item }}</option
                            >
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <b>Priority</b>
                        </div>
                        <div class="col-md-3">
                            <b>Task Name</b>
                        </div>
                        <div class="col-md-3">
                            <b>Project Name</b>
                        </div>
                        <div class="col-md-2">
                            <b>Created At</b>
                        </div>
                        <div class="col-md-2">
                            <b>Action</b>
                        </div>
                    </div>
                    <draggable v-model="tasks" @change="updateOrder">
                        <transition-group>
                            <div
                                v-for="(element, index) in tasks"
                                :key="element.id"
                            >
                                <div class="row">
                                    <div class="col-md-2">
                                        {{ index + 1 }}
                                    </div>
                                    <div class="col-md-3">
                                        {{ element.name }}
                                    </div>
                                    <div class="col-md-3">
                                        {{ element.project }}
                                    </div>
                                    <div class="col-md-2">
                                        {{ element.created_at }}
                                    </div>
                                    <div class="col-md-2">
                                        <button @click="editTask(element)">
                                            Edit
                                        </button>
                                        <button
                                            @click="deleteTask(element, index)"
                                        >
                                            Delete
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </transition-group>
                    </draggable>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import draggable from "vuedraggable";
export default {
    components: {
        draggable
    },
    data() {
        return {
            tasks: [],
            task: {},
            projects: [],
            job: null //add or edit
        };
    },
    mounted() {
        this.getAll();
        this.getProjectNames();
    },
    methods: {
        init() {
            this.task = {
                id: "",
                name: ""
            };
            this.job = null;
            // this.tasks = [];
            this.getAll();
            this.getProjectNames();
        },
        getProjectNames() {
            axios.get("/projects").then(response => {
                this.projects = response.data;
            });
        },
        addMore() {
            this.job = "add";
        },
        getAll() {
            axios.get("/tasks").then(response => {
                console.log(response.data);
                this.tasks = response.data;
            });
        },
        filterByProject(event) {
            var project = event.target.value;
            axios.get("/tasks?project=" + project).then(response => {
                this.tasks = response.data;
            });
        },
        save() {
            axios.post("/tasks", this.task).then(response => {
                this.init();
            });
        },
        update() {
            axios
                .post("/tasks/update/" + this.task.id, this.task)
                .then(response => {
                    this.init();
                });
        },
        updateOrder() {
            axios.post("/tasks/updateOrder/", this.tasks).then(response => {
                console.log(response.data);
                // this.init();
            });
        },
        editTask(task) {
            this.job = "edit";
            this.task = task;
        },
        deleteTask(task, index) {
            axios.delete("/tasks/delete/" + task.id).then(response => {
                this.tasks.splice(index, 1);
                alert("task has been deleted");
            });
        },
        dateis(date) {
            return new Date(date);
        }
    },
    computed: {}
};
</script>

<style>
.row {
    cursor: pointer;
}
</style>
