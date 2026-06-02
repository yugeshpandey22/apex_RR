<?php include 'includes/header.php'; ?>
<?php include 'includes/sidebar.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">Add Project</h4>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="projects">Projects</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add Project</li>
        </ol>
    </nav>
</div>

<div class="card shadow-sm mb-4">
    <div class="card-header card-header-blue py-3">
        Add New Project
    </div>
    <div class="card-body">
        <?php if(isset($_SESSION['success_msg'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= $_SESSION['success_msg']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION['success_msg']); ?>
        <?php endif; ?>

        <?php if(isset($_SESSION['error_msg'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= $_SESSION['error_msg']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION['error_msg']); ?>
        <?php endif; ?>

        <form action="process_project" method="POST" enctype="multipart/form-data">
            
            <!-- Tabs Nav -->
            <ul class="nav nav-tabs mb-4" id="projectTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="basic-tab" data-bs-toggle="tab" data-bs-target="#basic" type="button" role="tab" aria-controls="basic" aria-selected="true">Basic Info</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="media-tab" data-bs-toggle="tab" data-bs-target="#media" type="button" role="tab" aria-controls="media" aria-selected="false">Media & Slides</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="seo-tab" data-bs-toggle="tab" data-bs-target="#seo" type="button" role="tab" aria-controls="seo" aria-selected="false">SEO Aspects</button>
                </li>
            </ul>

            <!-- Tabs Content -->
            <div class="tab-content" id="projectTabsContent">
                
                <!-- Basic Info Tab -->
                <div class="tab-pane fade show active" id="basic" role="tabpanel" aria-labelledby="basic-tab">
                    <div class="mb-3">
                        <label for="projectCategory" class="form-label fw-bold">Project Category <span class="text-danger">*</span></label>
                        <select class="form-select" id="projectCategory" name="category" required>
                            <option value="rr_home">RR Home Project</option>
                            <option value="apex">Apex Project</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="projectTitle" class="form-label fw-bold">Project Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="projectTitle" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="shortDescription" class="form-label fw-bold">Short Description</label>
                        <textarea class="form-control" id="shortDescription" name="short_description" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label fw-bold">Description</label>
                        <textarea class="form-control richtext" id="description" name="description" rows="10"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="specifications" class="form-label fw-bold">Specifications</label>
                        <textarea class="form-control richtext" id="specifications" name="specifications" rows="10"></textarea>
                    </div>
                </div>

                <!-- Media & Slides Tab -->
                <div class="tab-pane fade" id="media" role="tabpanel" aria-labelledby="media-tab">
                    <div class="mb-3">
                        <label for="projectImages" class="form-label fw-bold">Project Images</label>
                        <input class="form-control" type="file" id="projectImages" name="images[]" multiple accept="image/*">
                        <div class="form-text">You can select multiple images.</div>
                    </div>
                </div>

                <!-- SEO Aspects Tab -->
                <div class="tab-pane fade" id="seo" role="tabpanel" aria-labelledby="seo-tab">
                    <div class="mb-3">
                        <label for="seoTitle" class="form-label fw-bold">SEO Title</label>
                        <input type="text" class="form-control" id="seoTitle" name="seo_title">
                    </div>
                    <div class="mb-3">
                        <label for="seoDescription" class="form-label fw-bold">SEO Description</label>
                        <textarea class="form-control" id="seoDescription" name="seo_description" rows="3"></textarea>
                    </div>
                </div>
                
            </div> <!-- End Tab Content -->

            <div class="mt-4">
                <button type="submit" class="btn btn-primary" name="add_project">Save Project</button>
                <a href="index" class="btn btn-secondary">Cancel</a>
            </div>
            
        </form>
    </div>
</div>

<?php include 'includes/footer.php'; ?>

