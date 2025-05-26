<?php get_header(); ?>

<div class="px-40 flex flex-1 justify-center py-5">
    <div class="layout-content-container flex flex-col max-w-[960px] flex-1">
        <div class="flex flex-col gap-20">
            <section class="flex flex-col gap-10">
                <header class="flex flex-col items-center gap-6 text-center">
                    <h1 class="text-[#1c110d] text-6xl font-bold leading-tight tracking-[-0.030em]">Savor the Moment, Taste the Tradition</h1>
                    <p class="text-[#9b5d4b] text-base font-normal leading-normal max-w-[480px]">
                        Experience culinary excellence at The Gilded Spoon, where every dish is a masterpiece and every visit is a celebration.
                    </p>
                </header>
                <div class="flex items-center justify-center gap-4">
                    <button
                        id="open-booking-modal-hero"
                        class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-xl h-10 px-4 bg-[#9b5d4b] text-[#fcf9f8] text-sm font-bold leading-normal tracking-[0.015em]"
                    >
                        <span class="truncate">Prenota Ora</span>
                    </button>
                    <button
                        class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-xl h-10 px-4 bg-[#f3eae7] text-[#1c110d] text-sm font-bold leading-normal tracking-[0.015em]"
                    >
                        <span class="truncate">View Menu</span>
                    </button>
                </div>
                <picture class="aspect-[1.78] w-full rounded-xl overflow-hidden">
                    <img
                        src="https://firebasestorage.googleapis.com/v0/b/codeless-dev.appspot.com/o/projects%2FYE0SoLpauRjS3f72h34j%2F540ef003f37a6922197a7f8f734a4e67d4d1991e_Rectangle%203.png?alt=media&token=898279f9-4cd2-4866-a462-a85c3dd9a22f"
                        alt="Hero Image"
                    />
                </picture>
            </section>
            <section class="flex flex-col gap-6" id="about-us">
                <h2 class="text-[#1c110d] text-4xl font-bold leading-tight tracking-[-0.020em] text-center">About Us</h2>
                <div class="grid grid-cols-1 gap-6 @[480px]:grid-cols-2">
                    <div class="flex flex-col items-center gap-4 rounded-xl border border-solid border-[#f3eae7] p-6">
                        <img
                            class="aspect-square w-20 rounded-lg"
                            src="https://firebasestorage.googleapis.com/v0/b/codeless-dev.appspot.com/o/projects%2FYE0SoLpauRjS3f72h34j%2F348f72a091afd8a9f5f8e6cad90f40c52165c331_Rectangle%204.png?alt=media&token=19231022-2525-41f4-95bb-7361cc687bf4"
                            alt="Our Story"
                        />
                        <h3 class="text-[#1c110d] text-lg font-bold leading-tight tracking-[-0.015em]">Our Story</h3>
                        <p class="text-[#9b5d4b] text-sm font-normal leading-normal text-center">
                            Founded in 1998, The Gilded Spoon has been a beacon of fine dining, blending traditional recipes with innovative culinary techniques.
                        </p>
                    </div>
                    <div class="flex flex-col items-center gap-4 rounded-xl border border-solid border-[#f3eae7] p-6">
                        <img
                            class="aspect-square w-20 rounded-lg"
                            src="https://firebasestorage.googleapis.com/v0/b/codeless-dev.appspot.com/o/projects%2FYE0SoLpauRjS3f72h34j%2F3f5507f457f03125495e0ac9c162682510a25489_Rectangle%205.png?alt=media&token=18972b66-864c-499f-9957-95296655f354"
                            alt="Our Philosophy"
                        />
                        <h3 class="text-[#1c110d] text-lg font-bold leading-tight tracking-[-0.015em]">Our Philosophy</h3>
                        <p class="text-[#9b5d4b] text-sm font-normal leading-normal text-center">
                            We believe in sourcing the freshest local ingredients, crafting memorable experiences, and treating every guest like family.
                        </p>
                    </div>
                </div>
            </section>
            <section class="flex flex-col gap-6 items-center">
                <h2 class="text-[#1c110d] text-4xl font-bold leading-tight tracking-[-0.020em] text-center">Our Location</h2>
                <div class="flex flex-col gap-2 text-center">
                    <p class="text-[#1c110d] text-base font-normal leading-normal">123 Culinary Avenue, Foodie City, FS 54321</p>
                    <a class="text-[#9b5d4b] text-base font-normal leading-normal" href="#">Get Directions</a>
                </div>
                <picture class="aspect-[2.33] w-full rounded-xl overflow-hidden">
                    <img
                        src="https://firebasestorage.googleapis.com/v0/b/codeless-dev.appspot.com/o/projects%2FYE0SoLpauRjS3f72h34j%2F040505d9517d611aa108921615f8a5401629f59d_Rectangle%206.png?alt=media&token=a840a5dc-72c8-4e99-8192-ac63c8c95f0a"
                        alt="Location map"
                    />
                </picture>
            </section>
        </div>
    </div>
</div>

<?php get_footer(); ?>
