<?php 
  /*
  * @var content ConceptualStudio\Models\Content\TourListingOverview
  */
?>

<section class="section section--overview to-animate" data-animate="up" id="overview">
    <div class="section__inner">
        <div class="grid grid-gap-md">
            <div class="col-6@md">
                <h2 class="text-lg">{{ $content->title }}</h3>
            </div>
            <div class="col-6@md">
                <div class="text-component">
                    <p>{{ $content->description }}</p>
                </div>
            </div>
        </div>
    </div>
</section>