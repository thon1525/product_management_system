<template>
    <Card class="lg:w-1/2 mx-auto">
      <template #title>Add New User</template>
      <template #content>
        <div class="p-fluid grid grid-cols-1 lg:grid-cols-2 gap-4">
          <div>
            <label for="firstName" class="text-sm">First Name</label>
            <InputText id="firstName" type="text" placeholder="Enter first name" />
          </div>
          <div>
            <label for="lastName" class="text-sm">Last Name</label>
            <InputText id="lastName" type="text" placeholder="Enter last name" />
          </div>
          <div>
            <label for="email" class="text-sm">Email</label>
            <InputText id="email" type="email" placeholder="Enter email" />
          </div>
          <div>
            <label for="phone" class="text-sm">Phone Number</label>
            <InputMask id="phone" mask="(999) 999-9999" placeholder="Phone" />
          </div>
          <div>
            <label for="dob" class="text-sm">Date of Birth</label>
            <Calendar id="dob" dateFormat="yy-mm-dd" showIcon />
          </div>
          <div>
            <label for="gender" class="text-sm">Gender</label>
            <Dropdown
              id="gender"
              :options="genderOptions"
              placeholder="Select Gender"
            />
          </div>
        </div>
      </template>
      <template #footer>
        <Button
          label="Add Now"
          icon="pi pi-check"
          class="w-full mt-4"
          @click="onSubmit"
        />
      </template>
    </Card>
  </template>

  <script>


  export default {
    name: "Section",
    data() {
      return {
        genderOptions: [
          { label: "Male", value: "Male" },
          { label: "Female", value: "Female" },
        ],
      };
    },
    methods: {
      onSubmit() {
        console.log("User form submitted!");
      },
    },
  };
  </script>
