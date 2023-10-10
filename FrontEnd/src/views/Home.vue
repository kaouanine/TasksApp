<style>
.max-height {
  max-height: 400px; /* Customize the maximum height as needed */
}
.gradient-custom {
  background: radial-gradient(50% 123.47% at 50% 50%, #00ff94 0%, #720059 100%),
    linear-gradient(121.28deg, #669600 0%, #ff0000 100%),
    linear-gradient(360deg, #0029ff 0%, #8fff00 100%),
    radial-gradient(100% 164.72% at 100% 100%, #6100ff 0%, #00ff57 100%),
    radial-gradient(100% 148.07% at 0% 0%, #fff500 0%, #51d500 100%);
  background-blend-mode: screen, color-dodge, overlay, difference, normal;
}
</style>

<template>
  <section class="vh-100 gradient-custom">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col col-xl-10">

          <div class="card">
            <div class="card-body p-5">

              <div class="d-flex justify-content-end align-items-center mb-4">

                <button type="button" data-bs-toggle="modal" data-bs-target="#TaskModal" class="btn btn-primary ms-2">Add
                  Task</button>
                <button type="button" @click="logout()" class="btn btn-danger ms-2">Log out</button>
              </div>
              <div class="input-group flex-nowrap">
              </div>
              <!-- Tabs navs -->
              <ul class="nav nav-tabs mb-4 pb-2" id="ex1" role="tablist">

              </ul>
              <!-- Tabs navs -->

              <!-- Tabs content -->
              <div class="tab-content" id="ex1-content">
                <div class="tab-pane fade show active overflow-auto max-height" id="ex1-tabs-1" role="tabpanel" aria-labelledby="ex1-tab-1">
                  <ul class="list-group mb-0">


                    <li v-for="task in tasks " :key=task.id class="list-group-item border-0 mb-2 rounded"
                      style="background-color: #f4f6f7;">
                      <div class="d-flex align-items-center ">
                        <input class="form-check-input me-2 col-2" type="checkbox" @change="CompletTask(task.id)" value=""
                          aria-label="..." :checked=task.completed />

                        <div class="col-6 ">{{ task.title }}</div>

                        <div class="d-flex  justify-content-end col-5  ">
                          <a class="btn btn-primary" data-bs-toggle="collapse" :href="'#collapseExample' + task.id"
                            role="button" aria-expanded="false" aria-controls="collapseExample">
                            description
                          </a>
                          <button class="btn btn-danger" @click="deleteTask(task.id)">delete</button>
                        </div>
                      </div>
                      <div class="collapse col-12" :id="'collapseExample' + task.id">
                        <br>

                        <div class="card card-body"> {{ task.description }}
                        </div>
                      </div>
                    </li>



                  </ul>
                </div>


              </div>
              <!-- Tabs content -->

            </div>
          </div>

        </div>
      </div>
    </div>
  </section>


  <div class="modal fade " id="TaskModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">New TASK</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form>
            <div class="mb-3">
              <label for="Title" class="col-form-label">Title:</label>
              <div class="text-danger"  v-for="validation in model.validation.title"> {{ validation }} </div>

              <input type="text" v-model="model.task.title" class="form-control" id="Title">

            </div>
            <div class="mb-3 ">
              <label for="Description-text" class="col-form-label">Description:</label>
              <div class="text-danger"  v-for="validation in model.validation.description"> {{ validation }} </div>

              <textarea class="form-control"  v-model="model.task.description" id="Description-text"
                style="height: 175px;"></textarea>

            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" @click="addTask" class="btn btn-primary">Add Task</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      tasks: [],
      model: {
        task: {
          title: '',
          description: '',
        },
        validation: {
          title : [''],
          description:['']
          
        }


      }
    }
  },
  mounted() {
    this.getTasks()

  },
  methods: {


    deleteTask(id) {

      this.http.delete('/deleteTask/' + id).then((response) => {
        this.$swal({ icon: 'success', title: 'Tasks has been Deletad', showConfirmButton: false, timer: 1000 });
        this.getTasks()

      }).catch((error) => {
/*         this.model.validation = error.response.data.error
 */      })
    },
    addTask() {

      this.http.post('/storeTask', this.model.task).then((response) => {
        if (response.status == 201) {
          this.$swal({ icon: 'success', title: 'Tasks has been created', showConfirmButton: false, timer: 1500 });
          this.getTasks()

        }
      }).catch((error) => {
        this.model.validation= error.response.data.error

      })
    },

    CompletTask(id) {

      this.http.put('/completeTask/' + id,).then((response) => {
        this.$swal({ icon: 'success', title: 'Task changed', showConfirmButton: false, timer: 1000 });
        this.getTasks()

      }).catch((error) => {
/*         this.model.validation = error.response.data.error
 */      })

    },
    getTasks() {
      this.http.get('/getTask').then((response) => {
        this.tasks = response.data.tasks, console.log(response.data)

      })
    },


    logout() {
      this.$store.commit('clearAuthToken');
      localStorage.removeItem('authToken');
      this.$router.push('/login');
    }
  }

}
</script>
