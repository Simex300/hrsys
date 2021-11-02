<template>
  <div>
    <div class="container">
      <h2>Update Employee</h2>
      <div class="panel panel-primary">
        <div class="panel-heading">
            Update Employee
            <router-link to="/" class="btn btn-info pull-right" style="margin-top:-7px;margin-left:2px;">Employee List</router-link>
        </div>
        <div class="panel-body">
          <form @submit.prevent="updateEmployee">
            <div class="form-group">
              <label>Name</label>
              <input type="text" class="form-control" v-model="employee.name" />
            </div>
            <div class="form-group">
              <label>Email</label>
              <input
                type="email"
                class="form-control"
                v-model="employee.email"
              />
            </div>
            <div class="form-group">
              <label>Mobile</label>
              <input
                type="text"
                class="form-control"
                v-model="employee.mobile"
              />
            </div>
            <div class="form-group">
              <label>Gender</label>
              <select class="form-control" v-model="employee.gender">
                <option value="">Select gender</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
              </select>
            </div>

            <button type="submit" class="btn btn-primary">Add</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      employee: {},
    };
  },
  created() {
    this.axios
      .get(`http://localhost:8000/api/employees/${this.$route.params.id}`)
      .then((res) => {
        this.employee = res.data;
      });
  },
  methods: {
    updateEmployee() {
      this.axios
        .patch(
          `http://localhost:8000/api/employees/${this.$route.params.id}`,
          this.employee
        )
        .then((res) => {
          this.$router.push({ name: "home" });
        });
    },
  },
};
</script>
