<div id="progress-wrapper" class="position-sticky top-0 start-0 w-100 bg-white z-3" >
    <div class="progress" style="height: 8px; border-radius:0px;">
         <div id="progress-bar" class="progress-bar bg-or" role="progressbar" style="width: 0%; transition: width 0.4s ease;"></div>
    </div>
</div>
<div class="container mt-5">
    <div id="step-container">

        <div class="container">
        <!-- Step 0: قوانین -->
        <div id="step-0" class="step active">
            <div class="header-box">&nbsp;</div>
            <h3>ابزار هوشمند محاسبه تعداد تار مو برای کاشت</h3>
            <div class="description">
                <div class="form-question">می&zwnj;خواهید بدانید به چند گرافت برای کاشت مو نیاز دارید؟</div>
                <p>این ابزار با استفاده از پاسخ شما به چند سؤال کوتاه می&zwnj;تواند تعداد تار مو مورد نیاز، مدت&zwnj;زمان انجام و دوره نقاهت پس از کاشت را با دقت تخمین بزند. این ابزار تلاش می&zwnj;کند تا یک دید واقعی و شخصی&zwnj;سازی&zwnj;شده از پروسه کاشت مو به مراجعین کلینیک فخرائی ارائه دهد؛ آن&zwnj;هم در خانه و تنها با چند کلیک! <br><strong>توجه:</strong> نتایج این ابزار حدودی هستند و نمی&zwnj;توانند جایگزین مشاوره تخصصی باشند. برای دریافت برنامه درمانی اختصاصی و دقیق، پیشنهاد می&zwnj;کنیم تا از مشاوره حضوری و رایگان در کلینیک فخرائی بهره ببرید.</p>
            </div>
            <div class="centrilized">
                <button class="btn form-button" id="agree-btn">تایید و شروع</button>
            </div>
        </div>

        <div id="step-1" class="step d-none">
        <form id="form-step-1" class="text-center">

            <!-- انتخاب جنسیت -->
            <div class="mb-4">
                <label class="d-block mb-2 fw-bold ">جنسیت خود را انتخاب کنید <span class="text-danger">*</span></label>
                <div class="g-box d-flex justify-content-center gap-3">
                    <label class="gender-option">
                    <input type="radio" name="gender" value="female" class="hidden-radio">
                    <div class="option-box">
                        <span>زن</span>
                        <img src="/assets/img/women.png" alt="زن">
                    </div>
                    </label>

                    <label class="gender-option">
                    <input type="radio" name="gender" value="male" class="hidden-radio">
                    <div class="option-box">
                        <span>مرد</span>
                        <img src="/assets/img/men.png" alt="مرد">
                    </div>
                    </label>
                </div>
            </div>

            <!-- بازه سنی -->
            <div class="mb-4">
                <label class="d-block mb-2 fw-bold ">بازه سنی خود را انتخاب کنید 
                <span class="text-danger">*</span></label>
                <div class="a-box d-flex justify-content-center gap-1">
                    <label class="age-option">
                    <input type="radio" name="age" value="female" class="hidden-radio">
                    <div class="option-box">
                        <span>18-23</span>
                    </div>
                    </label>

                    <label class="age-option">
                    <input type="radio" name="age" value="male" class="hidden-radio">
                    <div class="option-box">
                        <span>24-29</span>
                    </div>
                    </label>

                    <label class="age-option">
                    <input type="radio" name="age" value="male" class="hidden-radio">
                    <div class="option-box">
                        <span>30-35</span>
                    </div>
                    </label>

                    <label class="age-option">
                    <input type="radio" name="age" value="male" class="hidden-radio">
                    <div class="option-box">
                        <span>36-43</span>
                    </div>
                    </label>

                    <label class="age-option">
                    <input type="radio" name="age" value="male" class="hidden-radio">
                    <div class="option-box">
                        <span>44-56</span>
                    </div>
                    </label>

                    <label class="age-option">
                    <input type="radio" name="age" value="male" class="hidden-radio">
                    <div class="option-box">
                        <span>+56</span>
                    </div>
                    </label>
                </div>
            </div>

            <div class="mb-4">
                <label class="d-block mb-2 fw-bold">برای کاشت مو چقدر قطعیت دارید؟</label>
                <select name="confidence" class="form-select mx-auto" style="padding: 10px;border: 1px solid #ff6600;">
                    <option value="ریزش مو دارم و نمیدونم الان باید بکارم یا نه!">ریزش مو دارم و نمیدونم الان باید بکارم یا نه!</option>
                    <option value="می‌خوام مو بکارم اما دارم در این مورد تحقیق می‌کنم.">می‌خوام مو بکارم اما دارم در این مورد تحقیق می‌کنم.</option>
                    <option value="تصمیمم رو گرفتم و دنبال یه کلینیک خوب می‌گردم.">تصمیمم رو گرفتم و دنبال یه کلینیک خوب می‌گردم.</option>
                    <option value="قبلا مو کاشتم و دنبال کاشت مجدد و ترمیم هستم.">قبلا مو کاشتم و دنبال کاشت مجدد و ترمیم هستم.</option>
                </select>
            </div>

            <div class="mt-4 d-flex justify-content-between">
                <button type="button" class="btn btn-secondary btn-prev">مرحله قبل</button>
                <button type="submit" class="btn btn-primary">مرحله بعد</button>
            </div>
        </form>
        </div>
    </div>
        <!-- Step 2: extent of hair loss -->
        <div id="step-2" class="step d-none">
            <label class="d-block mb-2 fw-bold ">الگوی ریزش موی خود را انتخاب کنید</label>
            <form id="form-step-2">
                <div class="row g-4">

                    <?php for( $i=1 ; $i<=6 ; $i++){ ?>
                        
                    <div class="col-12 col-md-6">
                        <label class="pattern-option w-100 text-center">
                        <input type="radio" name="loss_pattern" value="pattern-<?php echo $i; ?>" hidden>
                        <img src="/assets/img/<?php echo $i; ?>.webp" data-colored="/assets/img/ol<?php echo $i; ?>.png" data-gray="/assets/img/<?php echo $i; ?>.webp" class="pattern-img img-fluid">
                        <div class="mt-2 fw-bold">الگوی <?php echo $i; ?></div>
                        </label>
                    </div>

                    <?php  }  ?>

                </div>

                <div class="mt-4 d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary btn-prev">مرحله قبل</button>
                    <button type="submit" class="btn btn-primary">مرحله بعد</button>
                </div>
            </form>
        </div>

        <!-- Step 3: آپلود عکس‌ها -->
        <div id="step-3" class="step d-none">
            <div class="container-image">
                <label class="d-block mb-2 fw-bold ">لطفاً عکس‌هایی از موی سر خود، از زوایای مشخص‌شده بارگذاری کنید. (اختیاری)</label>
                <div class="subheading0-image">چرا به این تصاویر نیاز داریم؟</div>
                <div class="description-image" dir="rtl" style="text-align: right;line-height: 1.8">
                    <p>تصاویر بانک مو و مناطقی که دچار ریزش مو شده&zwnj;اند، به مشاوران ما کمک می&zwnj;کنند تا راهنمایی بهتری ارائه کرده و یک برنامه درمانی شخصی&zwnj;سازی&zwnj;شده برای شما تنظیم کنند.</p>
                    <div class="privacy-note" style="margin-top: 1.5em;background: #ff5a0014;padding: 1em;border-radius: 8px;font-size: 0.95rem;color: #333">حریم خصوصی شما برای ما اهمیت زیادی دارد. تصاویر شما محرمانه نگهداری خواهند شد و هیچ&zwnj;گونه استفاده&zwnj;ای از آن&zwnj;ها نخواهد شد.</div>
                </div>
                <div class="angles">
                    <div class="angle"><img decoding="async" src="https://fakhraei.clinic/wp-content/uploads/2025/07/New-Project-80.webp" alt="نمای بالا"></div>
                    <div class="angle"><img decoding="async" src="https://fakhraei.clinic/wp-content/uploads/2025/07/2-pic-1.webp" alt="نمای سمت چپ"></div>
                    <div class="angle"><img decoding="async" src="https://fakhraei.clinic/wp-content/uploads/2025/07/3-pic-1.webp" alt="نمای پشت"></div>
                    <div class="angle"><img decoding="async" src="https://fakhraei.clinic/wp-content/uploads/2025/07/1-pic-1.webp" alt="نمای روبرو"></div>
                </div>
            </div>
            <form id="form-step-3" enctype="multipart/form-data">
                <div class="row g-3" id="upload-zones">
                <!-- باکس‌ها با JS ساخته می‌شن بر اساس gender -->
                </div>
                <div class="mt-4 d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary btn-prev">مرحله قبل</button>
                    <button type="submit" class="btn btn-primary">مرحله بعد</button>
                </div>
            </form>
        </div>

        <!-- Step 4: concerns & medical -->
        <div id="step-4" class="step d-none">
            <form id="form-step-4">
                <div class="mb-4">
                    <label class="d-block mb-2 fw-bold">نگرانی و دغدغه اصلی شما برای انجام کاشت مو کدام است؟</label>
                    <select name="concern" class="form-select mx-auto" style="padding: 10px;border: 1px solid #ff6600;">
                        <option value="مطمئن نیستم نتیجه کاشت خوب بشه یا نه.">مطمئن نیستم نتیجه کاشت خوب بشه یا نه.</option>
                        <option value="نگرانم نتیجه نهایی خیلی طول بکشه.">نگرانم نتیجه نهایی خیلی طول بکشه.</option>
                        <option value="نگرانم دوران نقاهت سختی داشته باشه.">نگرانم دوران نقاهت سختی داشته باشه.</option>
                        <option value="نگرانم خیلی درد داشته باشه.">نگرانم خیلی درد داشته باشه.</option>
                        <option value="هزینه برام خیلی مهمه.">هزینه برام خیلی مهمه.</option>
                        <option value="نگرانی دیگه ای دارم">نگرانی دیگه ای دارم</option>
                    </select>
                </div>
                <label class="d-block mb-2 ">آیا به بیماری خاصی مبتلا هستید؟</label>
                <div class="toggle-group">
                    <label class="toggle-option">
                    <input type="radio" name="has_medical" value="yes" hidden>
                    <span>بله</span>
                    </label>
                    <label class="toggle-option">
                    <input type="radio" name="has_medical" value="no" hidden>
                    <span>خیر</span>
                    </label>
                </div>

                <div id="medical-fields" class="d-none">
                    <label class="d-block mb-2 ">بیماری‌های پوستی</label>
                    <select name="scalp_conditions" class="form-select mx-auto" style="padding: 10px;border: 1px solid #ff6600;">
                        <option value="">انتخاب کنید</option>    
                        <option value="عفونت فعال پوست سر">عفونت فعال پوست سر</option>
                        <option value="پسوریازیس">پسوریازیس</option>
                        <option value="عفونت قارچی">عفونت قارچی</option>
                        <option value="فولیکولیت">فولیکولیت</option>
                        <option value="ریزش سکه‌ای (آلوپسی آره‌آتا)">ریزش سکه‌ای (آلوپسی آره‌آتا)</option>
                        <option value="آلوپسی به همراه اسکار">آلوپسی به همراه اسکار</option>
                        <option value="جای زخم (اسکار)">جای زخم (اسکار)</option>
                        <option value="هیچکدام">هیچکدام</option>
                    </select>
                    <label class="d-block mb-2 " style="margin:15px 0px;">سایر بیماری ها</label>
                    <select name="other_conditions" class="form-select mx-auto" style="padding: 10px;border: 1px solid #ff6600;">
                        <option value="">انتخاب کنید</option>    
                        <option value="دیابت">دیابت</option>
                        <option value="اختلالات انعقاد خون">اختلالات انعقاد خون</option>
                        <option value="بیماری قلبی">بیماری قلبی</option>
                        <option value="اختلالات تیروئید">اختلالات تیروئید</option>
                        <option value="ضعف سیستم ایمنی">ضعف سیستم ایمنی</option>
                        <option value="بیماری‌های خودایمنی">بیماری‌های خودایمنی</option>
                        <option value="هیچکدام">هیچکدام</option>
                    </select>
                </div>

                <label class="d-block mb-2 ">آیا در حال حاضر داروی خاصی مصرف می‌کنید؟</label>
                <div class="toggle-group">
                    <label class="toggle-option">
                    <input type="radio" name="has_meds" value="yes" hidden>
                    <span>بله</span>
                    </label>
                    <label class="toggle-option">
                    <input type="radio" name="has_meds" value="no" hidden>
                    <span>خیر</span>
                    </label>
                </div>

                <div id="meds-fields" class="d-none">
                    <input type="text" class="form-input mx-auto" style="padding: 10px;border: 1px solid #ff6600;" name="meds_list" placeholder="نام دارو را وارد کنید">
                </div>

                <div class="mt-4 d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary btn-prev">مرحله قبل</button>
                    <button type="submit" class="btn btn-primary">مرحله بعد</button>
                </div>
            </form>
        </div>

        <!-- Step 5: اطلاعات نهایی -->
        <div id="step-5" class="step d-none">
            <form id="form-step-5">
                <div class="container">
                    <p class="d-block mb-2 fw-bold">نام و نام خانوادگی خود را وارد کنید</p>
                    <div class="mt-1 d-flex gap-1 justify-content-between" style="padding:5px; margin-bottom:30px; border-bottom: 1px solid #CDCFCE;">
                        <input type="text" class="col-sm-12 col-md-6" name="first_name" placeholder="نام">
                        <input type="text" class="col-sm-12 col-md-6" name="last_name" placeholder="نام خانوادگی">
                    </div>
                    <p class="d-block mb-2 fw-bold"> محل سکونت خود را انتخاب کنید</p>
                    <div class="mt-1 d-flex gap-1 justify-content-between" style="padding:5px; margin-bottom:30px; ">
                        <input type="text" class="col-sm-12 col-md-6" name="state" placeholder="استان">
                        <input type="text" class="col-sm-12 col-md-6" name="city" placeholder="شهر">
                    </div>
                    <p class="d-block mb-2 fw-bold">شماره تلفن همراه خود را وارد کنید</p>
                    <div class="mt-1 d-flex gap-1 justify-content-between" style="padding:5px; margin-bottom:30px; ">
                        <input type="text" class="col-12" name="mobile" placeholder="شماره همراه">
                    </div>
                    <p class="d-block mb-2 fw-bold">از چه طریق تمایل به دریافت مشاوره تخصصی دارید؟</p>
                    <div class="mt-1 d-flex gap-1 justify-content-between" style="padding:5px; margin-bottom:30px; ">
                        <div class="toggle-group">
                            <label class="toggle-option">
                                <input type="radio" name="social" value="call" hidden>
                                <span>تماس</span>
                            </label>
                            <label class="toggle-option">
                                <input type="radio" name="social" value="whatsapp" hidden>
                                <span>واتس اپ</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="mt-4 d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary btn-prev">مرحله قبل</button>
                    <button type="submit" class="btn btn-primary">مرحله بعد</button>
                </div>
            </form>
        </div>

        <!-- Step 6: نمایش نتیجه -->
        <div id="step-6" class="step d-none">
            <h3>نتیجه</h3>
            <div id="result"></div>
            <button id="download-pdf">دانلود PDF</button>
        </div>

    </div>
</div>
