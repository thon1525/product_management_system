<template>
    <Card class="lg:w-1/2 mx-auto">

    </Card>
  </template>

  <script>
  export default {
    name: "DataUser",
    data() {
      return {
        // Gender Dropdown Options
        genderOptions: [
          { label: "Male", value: "Male" },
          { label: "Female", value: "Female" },
        ],
        // Form Data
        form: {
          firstName: "",
          lastName: "",
          email: "",
          phone: "",
          dob: null,
          gender: null,
        },
      };
    },
    methods: {
      // Handle Form Submission
      onSubmit() {
        console.log("Form Data:", this.form);
        alert(`Form Submitted Successfully!\n${JSON.stringify(this.form, null, 2)}`);
      },
    },
  };
  </script>

  <style scoped>
  .text-sm {
    font-size: 0.875rem;
  }
  .p-fluid {
    width: 100%;
  }
  .w-full {
    width: 100%;
  }
  .block {
    display: block;
  }
  .mt-6 {
    margin-top: 1.5rem;
  }
  </style>
