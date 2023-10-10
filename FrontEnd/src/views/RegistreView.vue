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

.fa-creative-commons-by {
  font-size: 19rem;
}

@media (max-width: 991px) {
  .fa-creative-commons-by {
    font-size: 12rem;
  }
};

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
                        <i class="fa-brands fa-creative-commons-by" style="color: #d6d6d6;"></i>
                      </div>
    
                    </div>
                    <div class="col-md-6 col-xl-4 text-center">
                        

                      <h2 class="fw-bold mb-4 pb-2">Create Account</h2>
    
                      <div class=" mb-3">
                      

                        <label class="form-label"  for="typeName">Name</label>

                        <input v-model="model.user.name" type="text" id="typeName" class="form-control form-control-lg " />
                        <div class="text-danger" v-for="validation in model.validation.name"> {{validation}}</div>

                      </div>
                      
                      <div class=" mb-3">
                        <label class="form-label" for="typeEmail">Email</label>
                        <input v-model="model.user.email" type="email" id="typeEmail" class="form-control form-control-lg " />
                        <div class="text-danger" v-for="validation in model.validation.email"> {{validation}}</div>

                      </div>
    
                      <div class=" mb-4">
                        <label class="form-label" for="typePassword">Password</label>
                        <input v-model="model.user.password" type="text" id="typePassword" class="form-control form-control-lg " />
                        <div class="text-danger" v-for="validation in model.validation.password" > {{validation}} </div>

                      </div>
    
                      <div class="text-center">
                        <button class="btn btn-info btn-block btn-lg"  @click=" saveUser" type="button">Save</button>
                        <br>

                        <router-link class="link-info" to="/login">Login <i class="fas fa-long-arrow-alt-right"></i></router-link>

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
            model:{
                user:{
                    name:'',
                    email:'',
                    password:''
                }
                  ,
                validation:{
                        email:'',name:'',password:''
                }    
                
            }
        }
    },
    mounted() {

    },
    methods: {
      saveUser(){

        this.http.post('/registre',this.model.user).then((response) => {
        if (response.status==201 ) {this.$swal({icon: 'success',title: 'Oops...',title:'Congratulations! Your account has been created', showConfirmButton: false,timer: 1500});this.$router.push('/login')
}
      }).catch((error) => {
        this.model.validation=error.response.data.error
      }) 
          }
    },
}
</script>
 