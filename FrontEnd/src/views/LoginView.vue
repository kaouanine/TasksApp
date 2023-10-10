
<style>
.intro {
  height: 100%;
}

@media (min-height: 300px) and (max-height: 450px) {
  .intro {
    height: auto;
  }
}

.gradient-custom {
  background: radial-gradient(50% 123.47% at 50% 50%, #00FF94 0%, #720059 100%), linear-gradient(121.28deg, #669600 0%, #FF0000 100%), linear-gradient(360deg, #0029FF 0%, #8FFF00 100%), radial-gradient(100% 164.72% at 100% 100%, #6100FF 0%, #00FF57 100%), radial-gradient(100% 148.07% at 0% 0%, #FFF500 0%, #51D500 100%);
  background-blend-mode: screen, color-dodge, overlay, difference, normal;
}

.fas.fa-laptop {
  font-size: 19rem;
}

@media (max-width: 991px) {
  .fas.fa-laptop {
    font-size: 12rem;
  }
}

;
</style>
<template>
  <section class="intro">
    <div class="mask d-flex align-items-center h-100 gradient-custom">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-12 col-xl-10">
            <div class="card">
              <div class="card-body p-5">

                <div class="row d-flex align-items-center">
                  <div class="col-md-6 col-xl-7">

                    <div class="text-center pt-md-5 pb-5 my-md-5" style="padding-right: 24px;">
                      <i class="fas fa-laptop" style="color: #D6D6D6;"></i>
                    </div>

                  </div>
                  <div class="col-md-6 col-xl-4 text-center">

                    <h2 class="fw-bold mb-4 pb-2">Member Login</h2>
                    <div class="text-danger"> {{ model.validation.message }}</div>

                    <div class=" mb-3">
                      <label class="form-label" for="typeEmail">Email</label>
                      <input v-model="model.user.email" type="email" id="typeEmail"
                        class="form-control form-control-lg " />
                        <div class="text-danger" v-for="validation in model.validation.email"> {{validation}}</div>
                    </div>

                    <div class=" mb-4">
                      <label class="form-label" for="typePassword">Password</label>
                      <input v-model="model.user.password" type="text" id="typePassword"
                        class="form-control form-control-lg" />
                        <div class="text-danger" v-for="validation in model.validation.password" > {{validation}} </div>

                    </div>

                    <div class="text-center">
                      <button class="btn btn-info btn-block btn-lg" @click="login" type="button">Login</button>
                      <br>
                      <router-link class="link-info" to="/registre">Create your Account <i
                          class="fas fa-long-arrow-alt-right"></i></router-link>

                    </div>

                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>
<script>
export default {
  data() {
    return {
      model: {
        user: {
          email: '',
          password: ''
        },
        validation: {
          email: '', password: '', message: ''
        }

      }
    }
  },
  mounted() {

  },
  methods: {
    login() {


      this.http.post('/login', this.model.user).then((response) => {
        this.model.validation.message = response.data.message
        const token=response.data.token
        this.$store.commit('setAuthToken', 'token');
        localStorage.setItem('authToken', token);
        this.$router.push('/')
      }).catch((error) => {
        error.response.status == 401 ? this.$swal({icon: 'error',title: 'Oops...',text: 'Please check your email and password!',}) : this.model.validation = error.response.data.error
      })
    }
  },
}
</script>