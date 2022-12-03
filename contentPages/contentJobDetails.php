<div class="container">
    <h3 class="jobName text-center"></h3>

    <div class="row jobDescriptionRow border p-2 m-2 rounded">
        <h5>Job description:</h5>
        <div class="jobDescription"></div>
    </div><!-- <div class="row jobDescription"> -->

    <div class="row application  border p-2 m-2 rounded">
        <h5>Application:</h5>
        <p>Enter the required information below to apply.</p>
        <form class="text-center" 
              action="Processes/processApplyJob.php" 
              enctype="multipart/form-data"
              method="post">
            <div class="row text-start">
                <div class="col-12 col-md-6">
                    <div class="form-group mb-3 d-none">
                        <input type="text" class="form-control" name="postNumber" id="hiddenPostNumber" readonly>
                    </div>
                    <div class="form-group mb-3">
                        <label for="firstName" class="form-label">First name</label>
                        <input type="text" class="form-control" name="firstName">
                    </div>
                    <div class="form-group mb-3">
                        <label for="lastName" class="form-label">Last name</label>
                        <input type="text" class="form-control" name="lastName">
                    </div>
                    <div class="form-group mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email">
                    </div>
                </div><!-- <div class="col-12 col-md-6"> -->
                <div class="col-12 col-md-6">
                    <div class="form-group mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" class="form-control" name="phone">
                    </div>
                    <div class="form-group">
                        <label for="uploadResume" class="form-label">Upload resume</label>
                        <input type="file" class="form-control mb-3 d-block" name="uploadResume">
                    </div>
                    <div class="form-group">
                        <label for="uploadCoverLetter" class="form-label">Upload cover letter (optional):</label>
                        <input type="file" class="form-control mb-3 d-block" name="uploadCoverLetter">
                    </div>
                </div><!-- <div class="col-12 col-md-6"> -->
            </div><!-- <div class="row"> -->
            <button type="submit"
                    class="btn btn-success mb-3"
                    name="APPLY_JOB">
                    <strong>Apply for this job</strong>
            </button>         
        </form>
        <input type="button" value="GENERATE_TEST_DATA" class="btnTestData btn btn-danger text-light">
    </div><!-- <div class="row application  border p-2 m-2 rounded"> -->

</div><!-- <div class="container"> -->

<script>
  document.querySelector(".btnTestData").addEventListener("click", function(){
    document.querySelector("input[name='firstName']").value="John";
    document.querySelector("input[name='lastName']").value="Doe";
    document.querySelector("input[name='phone']").value="042012345";
    document.querySelector("input[name='email']").value="johndoe@gmail.com";

  });
</script>