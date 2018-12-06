<?php require 'inc/config.php';?>
<?php require 'inc/functions.php';?>

<?php  $keywords="nepal,nepali news, news nepal, online news ,kantipur";?>

<?php require 'inc/header.php'; ?>

<?php
    $yesterday=date('Y-m-d',strtotime(date('Y-m-d')."-1 day"));
    $args= array(
        'where'=> "is_main = 1 AND status = 'Published' AND  DATE (added_date) >='".$yesterday."'",
        'order_by'=> 'id DESC',
        'limit'=>'0, 3'

    );
    $main_news=getNews($args);
    //debugger($main_news,true);
    if($main_news){
        foreach($main_news as $news_detail){
        ?>
    <section class="big-news">
        <div class="container">
            <div class="news-details">
                <div class="row">
                    <?php
                        $class="col-lg-8 col-md-6 col-sm-12";
                        if(!empty($news_detail)&& file_exists(UPLOAD_DIR.'/news/'.$news_detail['thumbnail'])){
                    ?>
                     <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="big-news-img">
                            <a href="#">
                                 <figure style='background-image: url("<?php echo IMAGES_URL; ?>court.jpg")'></figure>
                            </a>
                        </div>
                    </div>
                <?php }?>
                   
                    <div class="<?php echo $class; ?>">
                        <div class="big-news-detail news-title">
                            <h2><a href="#">निषेधित क्षेत्रविरुद्ध सर्वाेच्चमा मुद्दा दायर</a></h2>
                            <p>
                                <span>काठमाडौं– </span>
                                <span>सम्बाददाता</span>
                            </p>
                            <p>
                                सरकारले घोषणा गरेको निषेधित क्षेत्र खारेजीको माग गर्दै सर्वाेच्च अदालतमा मुद्दा दायर भएको छ। शुक्रबार वरिष्ठ अधिवक्ता दिनेश त्रिपाठीले माइतीघर मण्डला लगायतका  ठाउँमा प्रदर्शन गर्न नपाइने निर्णय खारेजीको माग गर्दै सर्वाेच्चमा रिट दायर गरेका हुन्। उनको मुद्दामा शुक्रबार सुनवाई हुनेछ। गृह प्रशासन सुधार योजना अन्तर्गत काठमाडौं जिल्ला प्रशासनले कार्यालयले माइतीघर मण्डलालाई निषेधित क्षेत्र घोषणा गर्दै ७ स्थानलाई प्रदर्शनस्थल तोकेको छ। गृहको निर्देशनअनुसार ७७ वटै जिल्लामा स्थानीय प्रशासनले निश्चित प्रदर्शन स्थल तोकेको छ। 
                            </p>
                            <span>२०७५-१०-०३, शनिबार</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php
    }
}
?>
    <section class="politics">
        <div class="container">
            <div class="section-title">
                <h2><a href="#">राजनीति</a></h2>
                <p><a href="#">सबै हर्नुहोस् <i class="fa fa-bars" aria-hidden="true"></i></a></p>
            </div>
            <div class="news-wrapper">
                <div class="row">
                    <div class="col-lg-5 col-md-6 col-sm-12">
                        <div class="politics-img-news news-title">
                             <figure style='background-image: url("<?php echo IMAGES_URL; ?>court.jpg")'></figure>
                            <h2><a href="#">निषेधित क्षेत्रविरुद्ध सर्वाेच्चमा मुद्दा दायर</a></h2>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-6 col-sm-12">
                        <div class="politics-news-list">
                            <div class="listing">
                                <div class="row">
                                    <div class="col-md-4">
                                        <a href="#"> <figure style='background-image: url("<?php echo IMAGES_URL; ?>court.jpg")'></figure></a>
                                    </div>
                                    <div class="col-md-8">
                                        <h3><a href="#">निषेधित क्षेत्रविरुद्ध सर्वाेच्चमा मुद्दा दायर</a></h3>
                                        <p>
                                            सरकारले घोषणा गरेको निषेधित क्षेत्र खारेजीको माग गर्दै सर्वाेच्च अदालतमा मुद्दा दायर भएको छ। शुक्रबार वरिष्ठ अधिवक्ता दिनेश त्रिपाठीले माइतीघर मण्डला लगायतका  ठाउँमा प्रदर्शन गर्न नपाइने निर्णय खारेजीको माग गर्दै सर्वाेच्चमा रिट दायर गरेका हुन्। 
                                        </p>
                                    </div>
                                     <div class="col-md-4">
                                        <a href="#"> <figure style='background-image: url("<?php echo IMAGES_URL; ?>court.jpg")'></figure></a>
                                    </div>
                                    <div class="col-md-8">
                                        <h3><a href="#">निषेधित क्षेत्रविरुद्ध सर्वाेच्चमा मुद्दा दायर</a></h3>
                                        <p>
                                            सरकारले घोषणा गरेको निषेधित क्षेत्र खारेजीको माग गर्दै सर्वाेच्च अदालतमा मुद्दा दायर भएको छ। शुक्रबार वरिष्ठ अधिवक्ता दिनेश त्रिपाठीले माइतीघर मण्डला लगायतका  ठाउँमा प्रदर्शन गर्न नपाइने निर्णय खारेजीको माग गर्दै सर्वाेच्चमा रिट दायर गरेका हुन्। 
                                        </p>
                                    </div>
                                    <div class="col-md-4">
                                        <a href="#"> <figure style='background-image: url("<?php echo IMAGES_URL; ?>court.jpg")'></figure></a>
                                    </div>
                                    <div class="col-md-8">
                                        <h3><a href="#">निषेधित क्षेत्रविरुद्ध सर्वाेच्चमा मुद्दा दायर</a></h3>
                                        <p>
                                            सरकारले घोषणा गरेको निषेधित क्षेत्र खारेजीको माग गर्दै सर्वाेच्च अदालतमा मुद्दा दायर भएको छ। शुक्रबार वरिष्ठ अधिवक्ता दिनेश त्रिपाठीले माइतीघर मण्डला लगायतका  ठाउँमा प्रदर्शन गर्न नपाइने निर्णय खारेजीको माग गर्दै सर्वाेच्चमा रिट दायर गरेका हुन्। 
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="money">
        <div class="container">
            <div class="section-title">
                <h2><a href="#">अर्थ</a></h2>
                <p><a href="#">सबै हर्नुहोस् <i class="fa fa-bars" aria-hidden="true"></i></a></p>
            </div>
            <div class="news-wrapper">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="money-listing">
                            <a herf="#"> <figure style='background-image: url("<?php echo IMAGES_URL; ?>court.jpg")'></figure></a>
                            <h3><a href="#">निषेधित क्षेत्रविरुद्ध सर्वाेच्चमा मुद्दा दायर</a></h3>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="money-listing">
                            <a herf="#"> <figure style='background-image: url("<?php echo IMAGES_URL; ?>court.jpg")'></figure></a>
                            <h3><a href="#">निषेधित क्षेत्रविरुद्ध सर्वाेच्चमा मुद्दा दायर</a></h3>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="money-listing">
                            <a herf="#"> <figure style='background-image: url("<?php echo IMAGES_URL; ?>court.jpg")'></figure></a>
                            <h3><a href="#">निषेधित क्षेत्रविरुद्ध सर्वाेच्चमा मुद्दा दायर</a></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="socity">
        <div class="container">
            <div class="section-title">
                <h2><a href="#">समाज</a></h2>
                <p><a href="#">सबै हर्नुहोस् <i class="fa fa-bars" aria-hidden="true"></i></a></p>
            </div>
            <div class="news-wrapper">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="socity-big">
                            <a href="#"> <figure style='background-image: url("<?php echo IMAGES_URL; ?>court.jpg")'></figure></a>
                            <h3><a href="#">निषेधित क्षेत्रविरुद्ध सर्वाेच्चमा मुद्दा दायर</a></h3>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="socity-small">
                                    <a href="#"> <figure style='background-image: url("<?php echo IMAGES_URL; ?>court.jpg")'></figure></a>
                                    <h3><a href="#">निषेधित क्षेत्रविरुद्ध सर्वाेच्चमा मुद्दा दायर</a></h3>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="socity-small">
                                    <a href="#"> <figure style='background-image: url("<?php echo IMAGES_URL; ?>court.jpg")'></figure></a>
                                    <h3><a href="#">निषेधित क्षेत्रविरुद्ध सर्वाेच्चमा मुद्दा दायर</a></h3>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="socity-small">
                                    <a href="#"> <figure style='background-image: url("<?php echo IMAGES_URL; ?>court.jpg")'></figure></a>
                                    <h3><a href="#">निषेधित क्षेत्रविरुद्ध सर्वाेच्चमा मुद्दा दायर</a></h3>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="socity-small">
                                    <a href="#"> <figure style='background-image: url("<?php echo IMAGES_URL; ?>court.jpg")'></figure></a>
                                    <h3><a href="#">निषेधित क्षेत्रविरुद्ध सर्वाेच्चमा मुद्दा दायर</a></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="video">
        <div class="container">
            <div class="section-title">
                <h2><a href="#">भिडियो</a></h2>
                <p><a href="#">सबै हर्नुहोस् <i class="fa fa-bars" aria-hidden="true"></i></a></p>
            </div>
            <div class="news-wrapper">
                <div class="row">
                    <div class="col-lg-7 col-md-7 col-sm-12">
                        <div class="big-video">
                            <iframe width="100%" height="100%" src="https://www.youtube.com/embed/jwDHDuxKU28?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                            <h3><a href="#">निषेधित क्षेत्रविरुद्ध सर्वाेच्चमा मुद्दा दायर</a></h3>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-5 col-sm-12">
                        <div class="small-video">
                            <div class="row">
                                <div class="col-md-5">
                                        <iframe width="100%" height="100%" src="https://www.youtube.com/embed/l482T0yNkeo?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                </div>
                                <div class="col-md-7">
                                        <h3><a href="#">निषेधित क्षेत्रविरुद्ध सर्वाेच्चमा मुद्दा दायर</a></h3>
                                </div>
                                <div class="col-md-5">
                                        <iframe width="100%" height="100%" src="https://www.youtube.com/embed/l482T0yNkeo?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                </div>
                                <div class="col-md-7">
                                        <h3><a href="#">निषेधित क्षेत्रविरुद्ध सर्वाेच्चमा मुद्दा दायर</a></h3>
                                </div>
                                <div class="col-md-5">
                                        <iframe width="100%" height="100%" src="https://www.youtube.com/embed/l482T0yNkeo?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                </div>
                                <div class="col-md-7">
                                        <h3><a href="#">निषेधित क्षेत्रविरुद्ध सर्वाेच्चमा मुद्दा दायर</a></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="gallery">
            <div class="container">
                <div class="section-title">
                    <h2><a href="#">भिडियो</a></h2>
                    <p><a href="#">सबै हर्नुहोस् <i class="fa fa-bars" aria-hidden="true"></i></a></p>
                </div>
                <div class="news-wrapper">
                    <div class="row">
                        <div class="col-lg-3 col-md-4 col-sm-12">
                            <div class="gallery-fig">
                                <img src="<?php echo IMAGES_URL; ?>court.jpg" style="max-height: 100%;">
                                <div class="gallery-hover">
                                    <a href="<?php echo IMAGES_URL;?>court.jpg" data-lilghtbox="gallery"><i class="fa fa-search-plus" aria-hidden="true"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-12">
                            <div class="gallery-fig">
                                <img src="<?php echo IMAGES_URL;?>court.jpg" style="max-height: 100%;">
                                <div class="gallery-hover">
                                    <a href="<?php echo IMAGES_URL; ?>court.jpg" data-lightbox="gallery"><i class="fa fa-search-plus" aria-hidden="true"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-12">
                            <div class="gallery-fig">
                                <img src="<?php echo IMAGES_URL;?>court.jpg" style="max-height: 100%;">
                                <div class="gallery-hover">
                                    <a href="<?php echo IMAGES_URL; ?>court.jpg" data-lightbox="gallery"><i class="fa fa-search-plus" aria-hidden="true"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-12">
                            <div class="gallery-fig">
                                <img src="<?php echo IMAGES_URL;?>court.jpg" style="max-height: 100%;">
                                <div class="gallery-hover">
                                    <a href="<?php echo IMAGES_URL; ?>court.jpg" data-lightbox="gallery"><i class="fa fa-search-plus" aria-hidden="true"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
             </div>
    </section>
     
<?php require 'inc/footer.php'?>