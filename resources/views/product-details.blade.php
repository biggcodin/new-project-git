<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <title>جزئیات محصول - قالب هاستینگ پلی هاست</title>
    <link rel="icon" href="images/icon.png" type="image/gif" sizes="16x16">
    <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Product Details Page" name="description">
    <meta content="" name="keywords">
    <meta content="" name="author">

    <!-- CSS Files -->
    <link href="css/bootstrap.rtl.min.css" rel="stylesheet" type="text/css">
    <link href="css/plugins.css" rel="stylesheet" type="text/css">
    <link href="css/swiper.css" rel="stylesheet" type="text/css">
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <link href="css/coloring.css" rel="stylesheet" type="text/css">
    <link id="colors" href="css/colors/scheme-01.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css ">

    <style>
        /* Reset and Base Styles */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            overflow-x: hidden;
            width: 100%;
            position: relative;
        }

        /* Global Background */
        body.dark-scheme {
            background: url('images/background/14.webp') no-repeat center center fixed !important;
            background-size: cover !important;
            position: relative;
            min-height: 100vh;
            width: 100%;
            margin: 0;
            padding: 0;
            color: #fff;
        }

        body.dark-scheme::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 0;
            pointer-events: none;
        }

        #wrapper {
            width: 100%;
            overflow-x: hidden;
            position: relative;
            z-index: 1;
            min-height: 100vh;
            background: transparent !important;
        }

        #content {
            position: relative;
            z-index: 1;
            background: transparent !important;
            min-height: 100vh;
        }

        .product-section {
            padding: 80px 0 40px 0;
            background: #f5f5f5;
            margin-top: 50px;
            width: 100%;
            position: relative;
            z-index: 1;
            min-height: calc(100vh - 50px);
        }

        .product-container {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            padding: 30px;
            max-width: 1000px;
            margin: 0 auto;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            position: relative;
            z-index: 2;
        }

        /* Ensure all content sections are transparent */
        section {
            background: transparent !important;
            position: relative;
            z-index: 1;
        }

        /* Make sure the header is transparent */
        header {
            background: transparent !important;
            position: relative;
            z-index: 1000;
        }

        /* Ensure footer is transparent */
        footer {
            background: transparent !important;
            position: relative;
            z-index: 1;
        }

        /* Adjust text colors for better visibility */
        .product-details h1,
        .product-details h2,
        .product-details h3,
        .product-details h4,
        .product-details h5,
        .product-details h6,
        .product-details p,
        .product-details span,
        .product-details label {
            color: #fff;
        }

        .product-content {
            display: flex;
            gap: 30px;
            align-items: flex-start;
            width: 100%;
            box-sizing: border-box;
            position: relative;
        }

        .product-gallery {
            flex: 0 0 500px;
            text-align: center;
            height: 600px;
            display: flex;
            flex-direction: column;
            gap: 30px;
            position: relative;
            padding-top: 20px;
            z-index: 1;
        }

        .product-image {
            position: relative;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            background: rgba(255, 255, 255, 0.05);
            padding: 0;
            border: 1px solid rgba(255, 255, 255, 0.1);
            width: 100%;
            height: 500px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 1;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            border-radius: 8px;
            transition: transform 0.3s ease;
            background: #222;
        }

        /* Remove hover effect */
        /* .product-image:hover img {
            transform: scale(1.05);
        } */

        /* Thumbnail Gallery */
        .product-thumbs {
            margin-top: 0;
            display: flex;
            gap: 12px;
            justify-content: center;
            flex-wrap: wrap;
            height: auto;
            position: relative;
            z-index: 2;
        }

        .thumb-item {
            width: 80px;
            height: 80px;
            border-radius: 8px;
            overflow: hidden;
            cursor: pointer;
            border: 2px solid transparent;
            transition: all 0.3s ease;
            aspect-ratio: 1;
            background: rgba(255, 255, 255, 0.05);
            padding: 3px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            position: relative;
            z-index: 2;
        }

        .thumb-item.active {
            border-color: var(--primary-color);
            transform: translateY(-3px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            z-index: 3;
        }

        .thumb-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .thumbs-container {
            display: flex;
            gap: 12px;
            justify-content: center;
            flex-wrap: wrap;
            max-height: 80px;
            overflow: hidden;
            transition: max-height 0.3s ease;
            position: relative;
            z-index: 2;
            scrollbar-width: thin;
            scrollbar-color: var(--primary-color) transparent;
        }

        .thumbs-container::-webkit-scrollbar {
            height: 6px;
        }

        .thumbs-container::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 3px;
        }

        .thumbs-container::-webkit-scrollbar-thumb {
            background: var(--primary-color);
            border-radius: 3px;
        }

        .thumbs-container.expanded {
            max-height: 172px;
            overflow-y: auto;
            z-index: 3;
        }

        .more-thumbs-btn {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            z-index: 2;
            opacity: 0.8;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .more-thumbs-btn:hover {
            background: rgba(255, 255, 255, 0.1);
            opacity: 1;
            transform: translateY(-2px) scale(1.05);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
        }

        .more-thumbs-btn:active {
            transform: translateY(0) scale(0.95);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .more-thumbs-btn i {
            font-size: 1.1rem;
            transition: all 0.3s ease;
        }

        .more-thumbs-btn.expanded {
            background: var(--primary-color);
            border-color: var(--primary-color);
            opacity: 1;
            transform: translateY(-2px) scale(1.05);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .more-thumbs-btn.expanded i {
            transform: rotate(180deg);
        }

        .more-thumbs-btn.expanded:hover {
            background: var(--secondary-color);
            border-color: var(--secondary-color);
            transform: translateY(-3px) scale(1.1);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.25);
        }

        .more-thumbs-btn::after {
            content: '';
            position: absolute;
            top: -5px;
            left: -5px;
            right: -5px;
            bottom: -5px;
            border-radius: 50%;
            background: var(--primary-color);
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: -1;
        }

        .more-thumbs-btn:hover::after {
            opacity: 0.1;
        }

        .more-thumbs-btn.expanded::after {
            opacity: 0.15;
        }

        @media (max-width: 768px) {
            .more-thumbs-btn {
                display: flex !important;
                width: 40px;
                height: 40px;
                margin: 10px auto 0;
                position: relative;
                z-index: 10;
                background: rgba(255, 255, 255, 0.05);
                border: 1px solid rgba(255, 255, 255, 0.1);
                color: #fff;
                cursor: pointer;
                transition: all 0.3s ease;
            }

            .more-thumbs-btn i {
                font-size: 1rem;
            }

            .more-thumbs-btn.expanded {
                background: var(--primary-color);
                border-color: var(--primary-color);
                opacity: 1;
                transform: translateY(-2px) scale(1.05);
            }

            .more-thumbs-btn.expanded i {
                transform: rotate(180deg);
            }

            .thumbs-container {
                max-height: 70px;
                overflow-x: auto;
                overflow-y: hidden;
                flex-wrap: nowrap;
                justify-content: flex-start;
                padding-bottom: 10px;
                -webkit-overflow-scrolling: touch;
                width: 100%;
                margin: 0;
                transition: max-height 0.3s ease;
                scrollbar-width: thin;
                scrollbar-color: var(--primary-color) transparent;
            }
        }

        /* Product Details */
        .product-details {
            flex: 1;
            background: rgba(255, 255, 255, 0.03);
            border-radius: 15px;
            padding: 25px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .product-title {
            font-size: 2.2rem;
            margin-bottom: 20px;
            color: #fff;
            font-weight: 600;
            line-height: 1.3;
        }

        .product-price {
            font-size: 1.8rem;
            color: var(--primary-color);
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 15px;
            background: rgba(255, 255, 255, 0.05);
            padding: 15px;
            gap: 20px;
        }

        .product-price .discount-badge {
            position: absolute;
            top: 0;
            left: 0;
            background: #ff4757;
            color: #fff;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 0.8rem;
            z-index: 2;
        }

        @media (min-width: 768px) {
            .product-price .discount-badge {
                margin-top: 10px;
                margin-left: 10px;
            }
        }

        .product-price .price-label {
            font-size: 0.9rem;
            color: #ccc;
        }

        .product-price .price-value {
            font-size: 1.2rem;
            color: var(--primary-color);
        }

        .product-description {
            margin: 30px 0;
            padding: 25px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .product-description h3 {
            color: #fff;
            margin-bottom: 20px;
            font-weight: 600;
            font-size: 1.4rem;
        }

        .product-description p {
            color: #ccc;
            font-size: 1.1rem;
            line-height: 1.6;
            margin-bottom: 15px;
        }

        .product-description p:last-child {
            margin-bottom: 0;
        }

        .product-meta {
            margin: 30px 0;
            padding: 25px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .meta-item {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            color: #ccc;
            font-size: 1.1rem;
        }

        .meta-item:last-child {
            margin-bottom: 0;
        }

        .meta-item i {
            color: var(--primary-color);
            margin-left: 10px;
            font-size: 1.2rem;
            width: 24px;
        }

        .product-actions {
            margin-top: 30px;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
        }

        .btn-add-cart {
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            color: #fff;
            border: none;
            padding: 15px 35px;
            border-radius: 12px;
            font-size: 1.1rem;
            display: flex;
            align-items: center;
            gap: 12px;
            transition: all 0.3s ease;
            width: auto;
            min-width: 220px;
            justify-content: center;
            box-shadow: 0 4px 15px rgba(var(--primary-color-rgb), 0.2);
            position: relative;
            overflow: hidden;
            font-weight: 500;
            letter-spacing: 0.5px;
        }

        .btn-add-cart:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(var(--primary-color-rgb), 0.3);
            background: linear-gradient(45deg, var(--secondary-color), var(--primary-color));
        }

        .btn-add-cart:active {
            transform: translateY(0);
            box-shadow: 0 2px 10px rgba(var(--primary-color-rgb), 0.2);
        }

        .btn-add-cart i {
            font-size: 1.2rem;
            transition: transform 0.3s ease;
        }

        .btn-add-cart:hover i {
            transform: scale(1.1);
        }

        .btn-add-cart::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0));
            transform: translateX(-100%);
            transition: transform 0.6s ease;
        }

        .btn-add-cart:hover::before {
            transform: translateX(100%);
        }

        @media (max-width: 768px) {
            .btn-add-cart {
                width: 100%;
                max-width: 300px;
                margin: 0 auto;
                padding: 12px 25px;
                font-size: 1rem;
            }
        }

        /* Product Tabs */
        .product-tabs {
            margin-top: 40px;
            padding: 30px 0;
        }

        .nav-tabs {
            border-bottom: none;
            display: flex;
            flex-wrap: nowrap;
            gap: 10px;
            background: rgba(13, 17, 23, 0.8);
            padding: 8px 15px;
            border-radius: 30px;
            justify-content: center;
            margin-bottom: 30px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: none;
            border: 1px solid rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
        }

        .nav-tabs .nav-link {
            color: #e0e0e0;
            background-color: transparent;
            font-weight: 500;
            padding: 10px 20px;
            border-radius: 30px;
            transition: all 0.3s ease;
            border: none;
            white-space: nowrap;
            text-align: center;
            flex: 0 0 auto;
            min-width: 120px;
        }

        .nav-tabs .nav-link:hover,
        .nav-tabs .nav-link.active {
            color: var(--primary-color);
            background-color: rgba(255, 255, 255, 0.1);
        }

        .tab-content {
            background: rgba(13, 17, 23, 0.8);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            color: #e0e0e0;
        }

        .tab-content h4 {
            color: #ffffff;
            margin-bottom: 20px;
            font-weight: 600;
            font-size: 1.2rem;
        }

        .tab-content p {
            color: #e0e0e0;
            line-height: 1.8;
            margin-bottom: 15px;
            font-size: 1rem;
        }

        .tab-content p:last-child {
            margin-bottom: 0;
        }

        /* Description Section */
        .feature-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .feature-list li {
            position: relative;
            padding-right: 25px;
            margin-bottom: 15px;
            color: #e0e0e0;
            text-align: right;
            font-size: 1.1rem;
            line-height: 1.6;
        }

        .feature-list li i {
            position: absolute;
            right: 0;
            top: 4px;
            color: var(--primary-color);
            font-size: 1.2rem;
        }

        .feature-list li:last-child {
            margin-bottom: 0;
        }

        /* Specifications Table */
        .specifications-section .table {
            color: #e0e0e0;
        }

        .specifications-section .table th {
            width: 150px;
            background: rgba(13, 17, 23, 0.9);
            color: #ffffff;
            vertical-align: middle;
            border-color: rgba(255, 255, 255, 0.15);
            font-weight: 600;
        }

        .specifications-section .table td {
            vertical-align: middle;
            color: #e0e0e0;
            border-color: rgba(255, 255, 255, 0.15);
            background: rgba(13, 17, 23, 0.6);
        }

        /* Reviews Section */
        .reviews-section {
            background: rgba(13, 17, 23, 0.8);
            padding: 20px;
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
        }

        .review-card {
            background: rgba(13, 17, 23, 0.6);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
            margin-bottom: 15px;
            border: 1px solid rgba(255, 255, 255, 0.15);
        }

        .review-header h5 {
            margin: 0;
            font-size: 1.1rem;
            font-weight: 600;
            color: #ffffff;
        }

        .review-date {
            color: #b0b0b0;
            font-size: 0.9rem;
        }

        .review-body p {
            color: #e0e0e0;
            line-height: 1.8;
            font-size: 1rem;
        }

        /* Star Rating */
        .rating-stars {
            font-size: 1.2rem;
            margin-bottom: 10px;
            cursor: pointer;
        }

        .rating-stars i {
            color: #ccc;
            margin-right: 5px;
        }

        .rating-stars i.text-warning {
            color: gold !important;
        }

        /* Add Review Form */
        .add-review-form {
            background: rgba(255, 255, 255, 0.95);
            padding: 25px;
            border-radius: 12px;
            margin-top: 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .add-review-form h5 {
            color: #333;
            font-size: 1.3rem;
            margin-bottom: 20px;
            font-weight: 600;
        }

        .add-review-form .form-label {
            color: #555;
            font-size: 1rem;
            margin-bottom: 8px;
            font-weight: 500;
        }

        .add-review-form .form-control {
            border-radius: 8px;
            padding: 12px;
            border: 1px solid #ddd;
            background: #fff;
            font-size: 1rem;
            color: #333;
            transition: all 0.3s ease;
        }

        .add-review-form .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(var(--primary-color-rgb), 0.1);
        }

        .add-review-form textarea.form-control {
            min-height: 120px;
            resize: vertical;
        }

        .add-review-form .rating-stars {
            font-size: 1.4rem;
            margin: 10px 0 20px;
        }

        .add-review-form .rating-stars i {
            color: #ddd;
            margin-right: 5px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .add-review-form .rating-stars i:hover,
        .add-review-form .rating-stars i.active {
            color: #ffd700;
        }

        .add-review-form .btn-primary {
            background: var(--primary-color);
            color: #fff;
            border: none;
            padding: 12px 30px;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            display: inline-block;
            text-align: center;
            width: 200px;
            height: 45px;
            line-height: 1;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease, box-shadow 0.2s ease, background-color 0.2s ease;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            user-select: none;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            outline: none !important;
            box-sizing: border-box;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        @media (max-width: 768px) {
            .add-review-form {
                text-align: center;
            }

            .add-review-form .btn-primary {
                width: 100%;
                max-width: 300px;
                margin: 0 auto;
                display: block;
            }
        }

        .add-review-form .btn-primary:hover {
            background: var(--secondary-color);
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        }

        .add-review-form .btn-primary:active {
            transform: translateY(0);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .add-review-form .btn-primary:focus {
            box-shadow: 0 0 0 3px rgba(var(--primary-color-rgb), 0.2);
        }

        .add-review-form .btn-primary:disabled {
            background: #ccc;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        /* Features Bottom */
        .product-bottom-features {
            margin-top: 40px;
            padding: 40px 0;
            background: transparent;
        }

        .feature-box {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            height: 100%;
            text-align: center;
            border: 1px solid rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
        }

        .feature-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            background: rgba(255, 255, 255, 0.08);
        }

        .feature-icon {
            font-size: 2rem;
            color: var(--primary-color);
            margin-bottom: 15px;
            display: flex;
            justify-content: center;
        }

        .feature-box h5 {
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 10px;
            color: #fff;
        }

        .feature-box p {
            font-size: 0.9rem;
            color: #ccc;
        }

        /* Related Products */
        .related-products {
            margin-top: 40px;
            margin-bottom: 80px;
            padding: 0;
        }

        .related-title {
            font-size: 1.5rem;
            margin-bottom: 30px;
            color: #333;
            text-align: center;
        }

        .related-products-wrapper {
            overflow-x: auto;
            white-space: nowrap;
            padding: 0 20px;
            -webkit-overflow-scrolling: touch;
            position: relative;
            scrollbar-width: thin;
            scrollbar-color: var(--primary-color) transparent;
        }

        .related-products-wrapper::-webkit-scrollbar {
            height: 6px;
        }

        .related-products-wrapper::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 3px;
        }

        .related-products-wrapper::-webkit-scrollbar-thumb {
            background: var(--primary-color);
            border-radius: 3px;
        }

        .related-products-list {
            display: flex;
            gap: 20px;
            min-width: max-content;
            padding-bottom: 20px;
            position: relative;
        }

        .scroll-item.gallery-item {
            width: 280px;
            display: inline-block;
            vertical-align: top;
            margin-right: 20px;
            position: relative;
        }

        .de-item {
            position: relative;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            height: 100%;
            outline: 0.2px solid rgba(0, 0, 0, 0.02);
            outline-offset: -0.2px;
        }

        .de-item * {
            pointer-events: none;
        }

        .de-item:focus {
            outline: 0.2px solid rgba(0, 0, 0, 0.02);
            outline-offset: -0.2px;
        }

        .de-item img {
            width: 100%;
            height: 350px;
            object-fit: cover;
            transition: transform 0.3s ease;
            border-radius: 16px;
        }

        .d-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 20px;
            opacity: 1;
            transition: opacity 0.3s ease;
            border-radius: 16px;
            pointer-events: auto;
        }

        .d-label {
            position: absolute;
            top: 15px;
            left: 15px;
            background: var(--primary-color);
            color: #fff;
            padding: 4px 8px;
            font-size: 0.8rem;
            z-index: 1;
            display: inline-block;
            text-align: center;
            border-radius: 8px;
            white-space: nowrap;
        }

        .d-text {
            text-align: right;
            color: #fff;
            width: 100%;
            pointer-events: auto;
        }

        .d-text h4 {
            font-size: 1rem;
            margin-bottom: 8px;
            font-weight: normal;
            text-align: right;
            color: #fff;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
        }

        .d-price {
            font-size: 0.85rem;
            margin-bottom: 12px;
            color: #fff;
            text-align: right;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
            font-weight: normal;
        }

        .d-price .price {
            color: #ffd700;
            font-weight: normal;
            font-size: 0.85rem;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
        }

        .btn-main {
            background: var(--primary-color);
            color: #fff;
            padding: 8px 15px;
            border-radius: 10px;
            text-decoration: none;
            transition: background-color 0.3s ease;
            display: inline-block;
            width: 100%;
            text-align: center;
            font-size: 0.9rem;
            outline: 0.2px solid rgba(0, 0, 0, 0.02);
            outline-offset: -0.2px;
            pointer-events: auto;
            cursor: pointer;
        }

        .btn-main:focus,
        .btn-main:active {
            outline: none !important;
        }

        .btn-main:hover {
            background: var(--secondary-color);
        }

        .btn-main span {
            display: inline-block;
            text-align: center;
            font-weight: 500;
        }

        .btn-fullwidth {
            width: 100%;
        }

        /* Mobile Title Section Styles */
        .mobile-title-section {
            text-align: right;
            margin-bottom: 20px;
            padding: 15px;
            background: transparent;
            position: relative;
            min-height: 60px;
        }

        .mobile-title-section .product-title {
            margin: 0;
            font-size: 1.5rem;
            text-align: right;
            padding-top: 25px;
            /* Space for discount badge */
        }

        .mobile-title-section .product-price {
            position: absolute;
            top: 15px;
            left: 15px;
            margin: 0;
        }

        .mobile-title-section .discount-badge {
            font-size: 0.9rem;
            padding: 4px 8px;
            display: inline-block;
            width: auto;
            white-space: nowrap;
        }

        @media (max-width: 768px) {
            .product-section {
                padding: 20px 0;
                margin-top: 0;
            }

            .product-container {
                padding: 15px 15px;
                margin: 60px 0 0 0;
                border-radius: 0;
                width: 100%;
            }

            .product-content {
                flex-direction: column;
                width: 100%;
                margin: 0;
                padding: 0;
            }

            .product-gallery {
                flex: 0 0 100%;
                height: auto;
                min-height: 300px;
                margin-bottom: 20px;
                overflow: hidden;
            }

            .product-image {
                height: 300px;
            }

            .product-thumbs {
                margin-top: 15px;
                padding: 0;
                width: 100%;
                overflow: visible;
                position: relative;
            }

            .thumbs-container {
                max-height: 70px;
                overflow-x: auto;
                overflow-y: hidden;
                flex-wrap: nowrap;
                justify-content: flex-start;
                padding-bottom: 10px;
                -webkit-overflow-scrolling: touch;
                width: 100%;
                margin: 0;
                transition: max-height 0.3s ease;
                scrollbar-width: thin;
                scrollbar-color: var(--primary-color) transparent;
            }

            .thumbs-container::-webkit-scrollbar {
                height: 6px;
            }

            .thumbs-container::-webkit-scrollbar-track {
                background: rgba(255, 255, 255, 0.1);
                border-radius: 3px;
            }

            .thumbs-container::-webkit-scrollbar-thumb {
                background: var(--primary-color);
                border-radius: 3px;
            }

            .thumbs-container.expanded {
                max-height: 150px;
                overflow-y: auto;
                flex-wrap: wrap;
                justify-content: center;
            }

            .thumbs-container::-webkit-scrollbar {
                display: none;
            }

            .thumb-item {
                width: 60px;
                height: 60px;
                flex: 0 0 60px;
                margin: 0 5px;
            }

            .thumb-item:first-child {
                margin-right: 0;
            }

            .thumb-item:last-child {
                margin-left: 0;
            }

            .more-thumbs-btn {
                display: flex;
                width: 40px;
                height: 40px;
                margin: 10px auto 0;
            }

            .more-thumbs-btn i {
                font-size: 1rem;
            }

            .more-thumbs-btn.expanded {
                background: var(--primary-color);
                border-color: var(--primary-color);
                opacity: 1;
                transform: translateY(-2px) scale(1.05);
            }

            .more-thumbs-btn.expanded i {
                transform: rotate(180deg);
            }
        }

        /* Product Image Swipe Styles */
        .product-image {
            touch-action: pan-y pinch-zoom;
            user-select: none;
            -webkit-user-select: none;
            -webkit-touch-callout: none;
            position: relative;
        }

        .product-image img {
            pointer-events: none;
        }

        /* Slider Dots */
        .slider-dots {
            position: absolute;
            bottom: 15px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 8px;
            z-index: 2;
            flex-direction: row;
        }

        .slider-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.5);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .slider-dot.active {
            background: var(--primary-color);
            transform: scale(1.2);
        }

        @media (max-width: 768px) {
            .product-gallery {
                width: 100%;
            }

            .product-image {
                width: 100%;
                background: rgba(0, 0, 0, 0.1);
            }

            .product-image img {
                width: 100%;
                height: auto;
                padding: 10px;
            }
        }

        /* Product Image Modal */
        .modal {
            z-index: 100000 !important;
        }

        .modal-dialog {
            z-index: 100001 !important;
        }

        .modal-backdrop {
            z-index: 99999 !important;
        }

        .modal-content {
            background: rgba(0, 0, 0, 0.95);
            border: none;
            border-radius: 15px;
            touch-action: none;
        }

        .modal-header {
            border-bottom: none;
            padding: 1rem;
            position: absolute;
            right: 0;
            z-index: 100002;
        }

        .btn-close {
            background-color: white;
            opacity: 0.8;
            margin: 0;
            position: relative;
            z-index: 100003;
            padding: 0.5rem;
            cursor: pointer;
        }

        .btn-close:hover {
            opacity: 1;
        }

        .modal-body {
            padding: 0;
            position: relative;
            touch-action: none;
            overflow: hidden;
        }

        .modal-body img {
            max-height: 80vh;
            width: auto;
            margin: 0 auto;
            touch-action: pan-x pan-y pinch-zoom;
            -webkit-user-select: none;
            user-select: none;
            -webkit-touch-callout: none;
        }

        .modal-nav-buttons {
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            transform: translateY(-50%);
            display: flex;
            justify-content: space-between;
            padding: 0 20px;
            pointer-events: none;
            z-index: 100002;
        }

        .modal-nav-btn {
            background: rgba(255, 255, 255, 0.1);
            border: none;
            color: white;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            pointer-events: auto;
            transition: background-color 0.2s ease;
            touch-action: manipulation;
            z-index: 100003;
        }

        .modal-nav-btn:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        .modal-nav-btn:active {
            background: rgba(255, 255, 255, 0.3);
        }

        .modal-nav-btn i {
            font-size: 1.2rem;
        }

        .modal-slider-dots {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 8px;
            z-index: 100002;
        }

        .modal-slider-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.5);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .modal-slider-dot.active {
            background: var(--primary-color);
            transform: scale(1.2);
        }

        @media (max-width: 768px) {
            .modal-body img {
                max-height: 60vh;
            }

            .modal-nav-btn {
                width: 45px;
                height: 45px;
            }

            .modal-nav-btn i {
                font-size: 1.1rem;
            }

            .modal-slider-dots {
                bottom: 15px;
            }
        }

        .gallery-nav-buttons {
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            transform: translateY(-50%);
            display: flex;
            justify-content: space-between;
            padding: 0 20px;
            pointer-events: none;
            z-index: 1001;
        }

        .gallery-nav-btn {
            background: rgba(255, 255, 255, 0.1);
            border: none;
            color: white;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            pointer-events: auto;
            transition: background-color 0.2s ease;
        }

        .gallery-nav-btn:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        .gallery-nav-btn:active {
            background: rgba(255, 255, 255, 0.3);
        }

        .gallery-nav-btn i {
            font-size: 1rem;
        }

        @media (max-width: 768px) {
            .gallery-nav-buttons {
                display: none;
            }
        }

        /* Scroll Indicators */
        .scroll-indicator {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 40px;
            height: 40px;
            background: rgba(0, 0, 0, 0.5);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            cursor: pointer;
            z-index: 10;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .scroll-indicator:hover {
            background: rgba(0, 0, 0, 0.7);
        }

        .scroll-indicator-left {
            left: 0;
        }

        .scroll-indicator-right {
            right: 0;
        }

        .related-products-wrapper:hover .scroll-indicator {
            opacity: 1;
        }

        @media (max-width: 768px) {
            .scroll-indicator {
                display: none;
            }
        }

        .float-text {
            width: 20px;
            position: fixed;
            z-index: 9999;
            margin-right: 7px;
            text-align: center;
            letter-spacing: 2px;
            font-size: 12px;
            top: 50%;
            right: 15px;
            transform: translate(-50%, -50%);
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.2s ease, visibility 0.2s ease;
            pointer-events: auto;
            display: block !important;
        }

        .float-text.show {
            opacity: 1;
            visibility: visible;
        }

        .float-text .desktop-text {
            margin-left: -5px;
            margin-top: 20px;
            writing-mode: vertical-rl;
            letter-spacing: .75px;
            -webkit-transform: rotate(-180deg);
            -ms-transform: rotate(-180deg);
            transform: rotate(-180deg);
            color: #222;
            font-size: 12px;
            line-height: 1.5;
        }

        .float-text .desktop-text a {
            color: inherit;
            text-decoration: none;
            display: block;
            padding: 5px 0;
        }

        .dark-scheme .float-text .desktop-text {
            color: #ffffff;
        }

        .float-text .mobile-icon {
            display: none;
        }

        @media (max-width: 768px) {
            .float-text {
                width: auto;
                height: auto;
                right: 20px;
                bottom: 20px;
                top: auto;
                transform: none;
                margin: 0;
                z-index: 9999;
                pointer-events: auto;
                display: block !important;
                position: fixed !important;
            }

            .float-text .desktop-text {
                display: none !important;
            }

            .float-text .mobile-icon {
                display: flex !important;
                color: #fff;
                background: var(--primary-color);
                width: 50px;
                height: 50px;
                border-radius: 50%;
                align-items: center;
                justify-content: center;
                text-shadow: none;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
                transition: all 0.3s ease;
                text-decoration: none;
            }

            .float-text .mobile-icon:hover {
                background: var(--secondary-color);
                transform: translateY(-3px);
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
            }

            .float-text .mobile-icon i {
                font-size: 20px;
                color: #fff;
            }

            .scrollbar-v {
                display: none !important;
            }
        }

        .dark-scheme .float-text a {
            color: #ffffff;
        }

        .scrollbar-v {
            background: var(--primary-color);
            position: fixed;
            top: calc(50% + 60px);
            right: 43px;
            width: 2px;
            transition: all linear 0.1s;
            min-height: 0%;
            z-index: 9998;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.2s ease, visibility 0.2s ease;
            pointer-events: auto;
            display: block !important;
        }

        .scrollbar-v.show {
            opacity: 1;
            visibility: visible;
        }

        .scrollbar-v:before {
            content: "";
            position: absolute;
            left: 0;
            width: 2px;
            min-height: 100px;
            background: rgba(0, 0, 0, .2);
        }

        .dark-scheme .scrollbar-v:before {
            background: rgba(255, 255, 255, .02);
        }

        @media (max-width: 768px) {
            .float-text {
                width: auto;
                height: auto;
                right: 20px;
                bottom: 20px;
                top: auto;
                transform: none;
                margin: 0;
                z-index: 9999;
                pointer-events: auto;
                display: block !important;
                position: fixed !important;
            }

            .float-text .desktop-text {
                display: none !important;
            }

            .float-text .mobile-icon {
                display: flex !important;
                color: #fff;
                background: var(--primary-color);
                width: 50px;
                height: 50px;
                border-radius: 50%;
                align-items: center;
                justify-content: center;
                text-shadow: none;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
                transition: all 0.3s ease;
                text-decoration: none;
            }

            .float-text .mobile-icon:hover {
                background: var(--secondary-color);
                transform: translateY(-3px);
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
            }

            .float-text .mobile-icon i {
                font-size: 20px;
                color: #fff;
            }

            .scrollbar-v {
                display: none !important;
            }
        }
    </style>
</head>

<body class="dark-scheme">
    <div id="wrapper">
        <div class="float-text show-on-scroll">
            <span class="desktop-text"><a href="#">به بالا بروید</a></span>
            <a href="#" class="mobile-icon"><i class="fas fa-chevron-up"></i></a>
        </div>
        <div class="scrollbar-v show-on-scroll"></div>
        <!-- page preloader begin -->
        <div id="de-loader"></div>
        <!-- page preloader close -->

        <!-- header begin -->
        <header class="transparent">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="de-flex sm-pt10">
                            <div class="de-flex-col">
                                <div class="de-flex-col">
                                    <!-- logo begin -->
                                    <div id="logo">
                                        <a href="index.html">
                                            <img class="logo-main" src="images/logo.png" alt="">
                                            <img class="logo-mobile" src="images/logo-mobile.png" alt="">
                                        </a>
                                    </div>
                                    <!-- logo close -->
                                </div>
                            </div>
                            <div class="de-flex-col header-col-mid">
                                <ul id="mainmenu" class="d-lg-flex">
                                    <li><a class="menu-item" href="index.html">خانه</a></li>
                                    <li><a class="menu-item" href="game-server-1.html">سرورهای بازی</a></li>
                                    <li><a class="menu-item" href="about.html">درباره ما</a></li>
                                    <li><a class="menu-item" href="contact.html">تماس با ما</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- header close -->

        <!-- Product Section -->
        <section class="product-section">
            <div class="product-container">
                <!-- Mobile Title Section -->
                <div class="mobile-title-section d-block d-md-none">
                    <h1 class="product-title">نام بازی</h1>
                    <div class="product-price">
                        <span class="discount-badge">17% تخفیف</span>
                    </div>
                </div>
                <div class="product-content">
                    <div class="product-gallery">
                        <div class="product-image" id="productImageContainer">
                            <img src="images/background/subheader-news.webp" alt="" id="mainProductImage">
                            <div class="slider-dots" id="sliderDots">
                                <!-- Dots will be generated dynamically -->
                            </div>
                            <div class="gallery-nav-buttons">
                                <button type="button" class="gallery-nav-btn" id="prevGalleryImage">
                                    <i class="fas fa-chevron-right"></i>
                                </button>
                                <button type="button" class="gallery-nav-btn" id="nextGalleryImage">
                                    <i class="fas fa-chevron-left"></i>
                                </button>
                            </div>
                        </div>
                        <div class="product-thumbs">
                            <div class="thumbs-container">
                                <div class="thumb-item active"><img src="images/background/subheader-news.webp"
                                        alt=""></div>
                                <div class="thumb-item"><img src="images/covers/2.webp" alt=""></div>
                                <div class="thumb-item"><img src="images/covers/3.webp" alt=""></div>
                                <div class="thumb-item"><img src="images/covers/4.webp" alt=""></div>
                                <div class="thumb-item"><img src="images/covers/5.webp" alt=""></div>
                                <div class="thumb-item"><img src="images/covers/6.webp" alt=""></div>
                                <div class="thumb-item"><img src="images/covers/7.webp" alt=""></div>
                                <div class="thumb-item"><img src="images/covers/8.webp" alt=""></div>
                                <div class="thumb-item"><img src="images/covers/1.webp" alt=""></div>
                                <div class="thumb-item"><img src="images/covers/2.webp" alt=""></div>
                                <div class="thumb-item"><img src="images/covers/3.webp" alt=""></div>
                                <div class="thumb-item"><img src="images/covers/4.webp" alt=""></div>
                                <div class="thumb-item"><img src="images/covers/5.webp" alt=""></div>
                                <div class="thumb-item"><img src="images/covers/6.webp" alt=""></div>
                                <div class="thumb-item"><img src="images/covers/7.webp" alt=""></div>
                                <div class="thumb-item"><img src="images/covers/8.webp" alt=""></div>
                            </div>
                            <div class="more-thumbs-btn" id="moreThumbsBtn">
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>
                    </div>

                    <div class="product-details">
                        <h1 class="product-title d-none d-md-block">نام بازی</h1>
                        <p class="product-description">
                            تجربه یک ماجراجویی منحصر به فرد در دنیای بازی با گرافیک فوق‌العاده و گیم‌پلی جذاب.
                        </p>
                        <div class="product-meta">
                            <div class="meta-item">
                                <i class="fa fa-gamepad"></i>
                                <span>شناسه بازی: GAME-001</span>
                            </div>
                            <div class="meta-item">
                                <i class="fa fa-tags"></i>
                                <span>ژانر: اکشن، تیمی، تک نفره</span>
                            </div>
                            <div class="meta-item">
                                <i class="fa fa-star"></i>
                                <span>امتیاز: 4.8 از 5</span>
                            </div>
                        </div>
                        <div class="product-price">
                            <span class="price-label">قیمت:</span>
                            <span class="price-value">1,500,000 تومان</span>
                            <span class="discount-badge d-none d-md-inline-block">17% تخفیف</span>
                        </div>
                        <div class="product-actions">
                            <button type="submit" class="btn-add-cart">
                                <i class="fa fa-shopping-bag"></i>
                                افزودن به سبد خرید
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product Tabs -->
            <div class="product-tabs">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="nav nav-tabs d-flex justify-content-center" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="description-tab" data-bs-toggle="tab"
                                        data-bs-target="#description" type="button" role="tab"
                                        aria-controls="description" aria-selected="true">توضیحات</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="specifications-tab" data-bs-toggle="tab"
                                        data-bs-target="#specifications" type="button" role="tab"
                                        aria-controls="specifications" aria-selected="false">مشخصات</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="reviews-tab" data-bs-toggle="tab"
                                        data-bs-target="#reviews" type="button" role="tab"
                                        aria-controls="reviews" aria-selected="false">نظرات (3)</button>
                                </li>
                            </ul>

                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="description" role="tabpanel">
                                    <div class="product-description">
                                        <h4>درباره بازی</h4>
                                        <p>تجربه یک ماجراجویی منحصر به فرد در دنیای بازی با گرافیک فوق‌العاده و گیم‌پلی
                                            جذاب.</p>
                                        <h4 class="mt-4">ویژگی‌های بازی</h4>
                                        <ul class="feature-list">
                                            <li><i class="fas fa-check-circle"></i> گرافیک فوق‌العاده و واقع‌گرایانه
                                            </li>
                                            <li><i class="fas fa-check-circle"></i> گیم‌پلی جذاب و متنوع</li>
                                            <li><i class="fas fa-check-circle"></i> حالت‌های بازی مختلف</li>
                                            <li><i class="fas fa-check-circle"></i> امکان بازی آنلاین و آفلاین</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="specifications" role="tabpanel">
                                    <div class="specifications-section">
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <th>نام بازی</th>
                                                    <td>نام بازی</td>
                                                </tr>
                                                <tr>
                                                    <th>ژانر</th>
                                                    <td>اکشن، تیمی، تک نفره</td>
                                                </tr>
                                                <tr>
                                                    <th>سازنده</th>
                                                    <td>شرکت بازی‌سازی</td>
                                                </tr>
                                                <tr>
                                                    <th>سال انتشار</th>
                                                    <td>2024</td>
                                                </tr>
                                                <tr>
                                                    <th>پلتفرم</th>
                                                    <td>PC, PS5, Xbox</td>
                                                </tr>
                                                <tr>
                                                    <th>زبان</th>
                                                    <td>فارسی، انگلیسی</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="reviews" role="tabpanel">
                                    <div class="reviews-section">
                                        <h4 class="mb-4">نظرات مشتریان</h4>
                                        <div class="comment-list">
                                            <div class="review-card mb-4">
                                                <div
                                                    class="review-header d-flex justify-content-between align-items-center">
                                                    <h5 class="mb-0">نام کاربر</h5>
                                                    <span class="review-date text-muted">2 روز پیش</span>
                                                </div>
                                                <div class="review-rating rating-stars">
                                                    <i class="far fa-star" data-value="1"></i>
                                                    <i class="far fa-star" data-value="2"></i>
                                                    <i class="far fa-star" data-value="3"></i>
                                                    <i class="far fa-star" data-value="4"></i>
                                                    <i class="far fa-star" data-value="5"></i>
                                                </div>
                                                <div class="review-body mt-2">
                                                    <p>تجربه بازی فوق‌العاده‌ای بود. گرافیک و گیم‌پلی عالی داره.</p>
                                                </div>
                                            </div>
                                            <div class="review-card mb-4">
                                                <div
                                                    class="review-header d-flex justify-content-between align-items-center">
                                                    <h5 class="mb-0">کاربر دوم</h5>
                                                    <span class="review-date text-muted">یک هفته پیش</span>
                                                </div>
                                                <div class="review-rating rating-stars">
                                                    <i class="fas fa-star text-warning" data-value="1"></i>
                                                    <i class="fas fa-star text-warning" data-value="2"></i>
                                                    <i class="fas fa-star text-warning" data-value="3"></i>
                                                    <i class="fas fa-star text-warning" data-value="4"></i>
                                                    <i class="fas fa-star text-warning" data-value="5"></i>
                                                </div>
                                                <div class="review-body mt-2">
                                                    <p>واقعاً دوست داشتم! امتیاز این بازی 5 از 5 ستاره است.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="add-review-form">
                                            <h5>نظر خود را بنویسید</h5>
                                            <form>
                                                <div class="mb-3">
                                                    <label for="reviewText" class="form-label">نظر شما</label>
                                                    <textarea class="form-control" id="reviewText" rows="3" placeholder="متن نظر خود را بنویسید..."></textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">امتیاز شما</label>
                                                    <div class="rating-stars" id="ratingStars">
                                                        <i class="far fa-star" data-value="1"></i>
                                                        <i class="far fa-star" data-value="2"></i>
                                                        <i class="far fa-star" data-value="3"></i>
                                                        <i class="far fa-star" data-value="4"></i>
                                                        <i class="far fa-star" data-value="5"></i>
                                                        <input type="hidden" name="rating" id="ratingValue"
                                                            value="0">
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-primary">ثبت نظر</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Features Bottom -->
            <div class="product-bottom-features">
                <div class="container">
                    <div class="row text-center">
                        <div class="col-lg-3 col-md-6 mb-4">
                            <div class="feature-box">
                                <div class="feature-icon"><i class="fas fa-download"></i></div>
                                <h5>نسخه دیجیتال</h5>
                                <p>دریافت فوری بدون نیاز به CD</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 mb-4">
                            <div class="feature-box">
                                <div class="feature-icon"><i class="fas fa-headphones-alt"></i></div>
                                <h5>پشتیبانی 24/7</h5>
                                <p>پشتیبانی دائمی و لحظه‌ای</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 mb-4">
                            <div class="feature-box">
                                <div class="feature-icon"><i class="fas fa-shipping-fast"></i></div>
                                <h5>ارسال فوری</h5>
                                <p>تحویل لحظه‌ای محصول</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 mb-4">
                            <div class="feature-box">
                                <div class="feature-icon"><i class="fas fa-undo"></i></div>
                                <h5>ضمانت بازگشت</h5>
                                <p>بازگشت وجه در صورت عدم رضایت</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Related Products with Horizontal Scroll -->
            <!-- Related Products -->
            <div class="related-products">
                <div class="container">
                    <!-- Title -->
                    <div class="row mb-3">
                        <div class="col-lg-12 text-center">
                            <h3 class="related-title">بازی‌های مرتبط</h3>
                        </div>
                    </div>

                    <!-- Scrollable List -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="related-products-wrapper">
                                <div class="related-products-list" id="relatedProductsList">

                                    <!-- Game Item -->
                                    <div class="scroll-item gallery-item">
                                        <div class="de-item">
                                            <div class="d-overlay"
                                                style="background-size: cover; background-repeat: no-repeat;">
                                                <div class="d-label"
                                                    style="background-size: cover; background-repeat: no-repeat;">%20
                                                    تخفیف</div>
                                                <div class="d-text"
                                                    style="background-size: cover; background-repeat: no-repeat;">
                                                    <h4>تندر و شهر</h4>
                                                    <p class="d-price">شروع قیمت از <span class="price">1,499,000
                                                            تومان</span></p>
                                                    <a class="btn-main btn-fullwidth"
                                                        href="pricing-table-one.html"><span>هم اکنون سفارش
                                                            دهید</span></a>
                                                </div>
                                            </div>
                                            <img src="images/covers/1.webp" class="img-fluid" alt="">
                                        </div>
                                    </div>

                                    <!-- Game Item -->
                                    <div class="scroll-item gallery-item">
                                        <div class="de-item">
                                            <div class="d-overlay"
                                                style="background-size: cover; background-repeat: no-repeat;">
                                                <div class="d-label"
                                                    style="background-size: cover; background-repeat: no-repeat;">%15
                                                    تخفیف</div>
                                                <div class="d-text"
                                                    style="background-size: cover; background-repeat: no-repeat;">
                                                    <h4>ماجراجویی جدید</h4>
                                                    <p class="d-price">شروع قیمت از <span class="price">1,299,000
                                                            تومان</span></p>
                                                    <a class="btn-main btn-fullwidth"
                                                        href="pricing-table-one.html"><span>هم اکنون سفارش
                                                            دهید</span></a>
                                                </div>
                                            </div>
                                            <img src="images/covers/2.webp" class="img-fluid" alt="">
                                        </div>
                                    </div>

                                    <!-- Game Item -->
                                    <div class="scroll-item gallery-item">
                                        <div class="de-item">
                                            <div class="d-overlay"
                                                style="background-size: cover; background-repeat: no-repeat;">
                                                <div class="d-label"
                                                    style="background-size: cover; background-repeat: no-repeat;">%25
                                                    تخفیف</div>
                                                <div class="d-text"
                                                    style="background-size: cover; background-repeat: no-repeat;">
                                                    <h4>جنگ ستارگان</h4>
                                                    <p class="d-price">شروع قیمت از <span class="price">1,799,000
                                                            تومان</span></p>
                                                    <a class="btn-main btn-fullwidth"
                                                        href="pricing-table-one.html"><span>هم اکنون سفارش
                                                            دهید</span></a>
                                                </div>
                                            </div>
                                            <img src="images/covers/3.webp" class="img-fluid" alt="">
                                        </div>
                                    </div>

                                    <!-- Game Item -->
                                    <div class="scroll-item gallery-item">
                                        <div class="de-item">
                                            <div class="d-overlay"
                                                style="background-size: cover; background-repeat: no-repeat;">
                                                <div class="d-label"
                                                    style="background-size: cover; background-repeat: no-repeat;">%10
                                                    تخفیف</div>
                                                <div class="d-text"
                                                    style="background-size: cover; background-repeat: no-repeat;">
                                                    <h4>ماجراجویی فضایی</h4>
                                                    <p class="d-price">شروع قیمت از <span class="price">1,399,000
                                                            تومان</span></p>
                                                    <a class="btn-main btn-fullwidth"
                                                        href="pricing-table-one.html"><span>هم اکنون سفارش
                                                            دهید</span></a>
                                                </div>
                                            </div>
                                            <img src="images/covers/4.webp" class="img-fluid" alt="">
                                        </div>
                                    </div>

                                    <!-- Game Item -->
                                    <div class="scroll-item gallery-item">
                                        <div class="de-item">
                                            <div class="d-overlay"
                                                style="background-size: cover; background-repeat: no-repeat;">
                                                <div class="d-label"
                                                    style="background-size: cover; background-repeat: no-repeat;">%20
                                                    تخفیف</div>
                                                <div class="d-text"
                                                    style="background-size: cover; background-repeat: no-repeat;">
                                                    <h4>اودیسه کهکشانی</h4>
                                                    <p class="d-price">شروع قیمت از <span class="price">1,499,000
                                                            تومان</span></p>
                                                    <a class="btn-main btn-fullwidth"
                                                        href="pricing-table-one.html"><span>هم اکنون سفارش
                                                            دهید</span></a>
                                                </div>
                                            </div>
                                            <img src="images/covers/5.webp" class="img-fluid" alt="">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>

    <!-- footer -->
    <footer>
        <div class="container">
            <div class="row gx-5">
                <div class="col-lg-4">
                    <img src="images/logo.png" alt="">
                    <div class="spacer-20"></div>
                    <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است،
                        چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است، و برای شرایط فعلی تکنولوژی
                        مورد نیاز، و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد.</p>
                </div>
                <div class="col-lg-4">
                    <div class="row">
                        <div class="col-lg-6 col-sm-6">
                            <div class="widget">
                                <h5> سرور بازی</h5>
                                <ul>
                                    <li><a href="#">تندر و شهر</a></li>
                                    <li><a href="#">مسابقه مرموز الف</a></li>
                                    <li><a href="#">خشم خاموش</a></li>
                                    <li><a href="#">سیاهچال فانک</a></li>
                                    <li><a href="#">اودیسه کهکشانی</a></li>
                                    <li><a href="#">افسانه جنگ</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6">
                            <div class="widget">
                                <h5>صفحات</h5>
                                <ul>
                                    <li><a href="#"> سرور بازی</a></li>
                                    <li><a href="#">پایگاه دانش</a></li>
                                    <li><a href="#">درباره ما</a></li>
                                    <li><a href="#">بازاریابی</a></li>
                                    <li><a href="#">مکان ها</a></li>
                                    <li><a href="#">اخبار</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="widget">
                        <h5>خبرنامه</h5>
                        <form action="blank.php" class="row form-dark" id="form_subscribe" method="post"
                            name="form_subscribe">
                            <div class="col text-center">
                                <a href="#" id="btn-subscribe"><i
                                        class="arrow_left bg-color-secondary"></i></a> <input class="form-control"
                                    id="txt_subscribe" name="txt_subscribe" placeholder="ایمیل خود را وارد کنید"
                                    type="text">
                                <div class="clearfix"></div>
                            </div>
                        </form>
                        <div class="spacer-10"></div>
                        <small>ایمیل شما نزد ما محفوظ است. ما اسپم نمی کنیم.</small>
                        <div class="spacer-30"></div>
                        <div class="widget">
                            <h5>ما را دنبال کنید</h5>
                            <div class="social-icons">
                                <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                                <a href="#"><i class="fa-brands fa-twitter"></i></a>
                                <a href="#"><i class="fa-brands fa-discord"></i></a>
                                <a href="#"><i class="fa-brands fa-tiktok"></i></a>
                                <a href="#"><i class="fa-brands fa-youtube"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="subfooter">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-sm-6">
                        کپی رایت 2024 - طراحی شده توسط روشاک
                    </div>
                    <div class="col-lg-6 col-sm-6 text-lg-end text-sm-start">
                        <ul class="menu-simple">
                            <li><a href="#">شرایط &amp; قوانین</a></li>
                            <li><a href="#">سیاست حفظ حریم خصوصی</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer close -->

    </div>
    <!-- wrapper close -->

    <!-- JS Files -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/designesia.js"></script>

    <!-- Product Image Modal -->
    <div class="modal fade" id="productImageModal" tabindex="-1" aria-labelledby="productImageModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center position-relative">
                    <img src="" id="modalProductImage" class="img-fluid" alt="Product Image">
                    <div class="modal-nav-buttons">
                        <button type="button" class="modal-nav-btn" id="prevImage">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                        <button type="button" class="modal-nav-btn" id="nextImage">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                    </div>
                    <div class="modal-slider-dots" id="modalSliderDots"></div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize modal
            const productModal = new bootstrap.Modal(document.getElementById('productImageModal'));
            const modalImage = document.getElementById('modalProductImage');
            const mainImage = document.getElementById('mainProductImage');
            const thumbnails = document.querySelectorAll('.thumb-item img');
            let currentImageIndex = 0;
            let touchStartX = 0;
            let touchEndX = 0;
            let isDragging = false;

            // Generate slider dots dynamically
            const sliderDots = document.getElementById('sliderDots');
            const modalSliderDots = document.getElementById('modalSliderDots');

            // Clear existing dots
            sliderDots.innerHTML = '';
            modalSliderDots.innerHTML = '';

            // Create dots based on number of thumbnails
            thumbnails.forEach((_, index) => {
                // Create dot for main slider
                const dot = document.createElement('div');
                dot.className = 'slider-dot' + (index === 0 ? ' active' : '');
                dot.addEventListener('click', () => {
                    currentImageIndex = index;
                    updateGalleryImage();
                    updateGalleryDots();
                });
                sliderDots.appendChild(dot);

                // Create dot for modal slider
                const modalDot = document.createElement('div');
                modalDot.className = 'modal-slider-dot' + (index === 0 ? ' active' : '');
                modalDot.addEventListener('click', () => {
                    currentImageIndex = index;
                    updateModalImage();
                    updateModalDots();
                });
                modalSliderDots.appendChild(modalDot);
            });

            // Update gallery dots
            function updateGalleryDots() {
                document.querySelectorAll('#sliderDots .slider-dot').forEach((dot, index) => {
                    dot.classList.toggle('active', index === currentImageIndex);
                });
            }

            // Update modal dots
            function updateModalDots() {
                document.querySelectorAll('.modal-slider-dot').forEach((dot, index) => {
                    dot.classList.toggle('active', index === currentImageIndex);
                });
            }

            // Gallery touch events
            const productGallery = document.querySelector('.product-gallery');
            let galleryTouchStartX = 0;
            let galleryTouchEndX = 0;
            let isGalleryDragging = false;

            productGallery.addEventListener('touchstart', function(e) {
                galleryTouchStartX = e.changedTouches[0].screenX;
                isGalleryDragging = true;
            }, {
                passive: true
            });

            productGallery.addEventListener('touchmove', function(e) {
                if (!isGalleryDragging) return;
                galleryTouchEndX = e.changedTouches[0].screenX;
            }, {
                passive: true
            });

            productGallery.addEventListener('touchend', function(e) {
                if (!isGalleryDragging) return;
                galleryTouchEndX = e.changedTouches[0].screenX;
                handleGallerySwipe();
                isGalleryDragging = false;
            }, {
                passive: true
            });

            function handleGallerySwipe() {
                const swipeThreshold = 50; // minimum distance for swipe
                const swipeDistance = galleryTouchEndX - galleryTouchStartX;

                if (Math.abs(swipeDistance) > swipeThreshold) {
                    if (swipeDistance < 0) {
                        // Swipe left - show previous image
                        showPreviousGalleryImage();
                    } else {
                        // Swipe right - show next image
                        showNextGalleryImage();
                    }
                }
            }

            function showPreviousGalleryImage() {
                if (currentImageIndex === 0) {
                    currentImageIndex = thumbnails.length - 1;
                } else {
                    currentImageIndex--;
                }
                updateGalleryImage();
            }

            function showNextGalleryImage() {
                if (currentImageIndex === thumbnails.length - 1) {
                    currentImageIndex = 0;
                } else {
                    currentImageIndex++;
                }
                updateGalleryImage();
            }

            function updateGalleryImage() {
                mainImage.src = thumbnails[currentImageIndex].src;
                document.querySelectorAll('.thumb-item').forEach((thumb, index) => {
                    thumb.classList.toggle('active', index === currentImageIndex);
                });
                updateGalleryDots();
            }

            // Handle thumbnail clicks
            document.querySelectorAll('.thumb-item').forEach((thumb, index) => {
                thumb.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    document.querySelectorAll('.thumb-item').forEach(t => t.classList.remove(
                        'active'));
                    this.classList.add('active');
                    currentImageIndex = index;
                    mainImage.src = this.querySelector('img').src;
                    updateGalleryDots();
                });
            });

            // Initialize gallery dots
            updateGalleryDots();

            // Open modal when main image is clicked
            document.getElementById('productImageContainer').addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                modalImage.src = mainImage.src;
                currentImageIndex = Array.from(thumbnails).findIndex(thumb => thumb.src === mainImage.src);
                updateModalDots();
                productModal.show();
            });

            // Handle previous button
            document.getElementById('prevImage').addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                showPreviousImage();
            });

            // Handle next button
            document.getElementById('nextImage').addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                showNextImage();
            });

            function showPreviousImage() {
                if (currentImageIndex === 0) {
                    currentImageIndex = thumbnails.length - 1;
                } else {
                    currentImageIndex--;
                }
                updateModalImage();
            }

            function showNextImage() {
                if (currentImageIndex === thumbnails.length - 1) {
                    currentImageIndex = 0;
                } else {
                    currentImageIndex++;
                }
                updateModalImage();
            }

            function updateModalImage() {
                modalImage.src = thumbnails[currentImageIndex].src;
                updateModalDots();
            }

            // Touch events for modal swipe
            const modalBody = document.querySelector('.modal-body');

            modalBody.addEventListener('touchstart', function(e) {
                touchStartX = e.changedTouches[0].screenX;
                isDragging = true;
            }, {
                passive: true
            });

            modalBody.addEventListener('touchmove', function(e) {
                if (!isDragging) return;
                touchEndX = e.changedTouches[0].screenX;
            }, {
                passive: true
            });

            modalBody.addEventListener('touchend', function(e) {
                if (!isDragging) return;
                touchEndX = e.changedTouches[0].screenX;
                handleSwipe();
                isDragging = false;
            }, {
                passive: true
            });

            function handleSwipe() {
                const swipeThreshold = 50; // minimum distance for swipe
                const swipeDistance = touchEndX - touchStartX;

                if (Math.abs(swipeDistance) > swipeThreshold) {
                    if (swipeDistance < 0) {
                        // Swipe left - show previous image
                        showPreviousImage();
                    } else {
                        // Swipe right - show next image
                        showNextImage();
                    }
                }
            }

            // Keyboard navigation
            document.addEventListener('keydown', function(e) {
                if (productModal._element.classList.contains('show')) {
                    if (e.key === 'ArrowLeft') {
                        showPreviousImage();
                    } else if (e.key === 'ArrowRight') {
                        showNextImage();
                    }
                }
            });

            // Handle gallery navigation buttons
            document.getElementById('prevGalleryImage').addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                showPreviousGalleryImage();
            });

            document.getElementById('nextGalleryImage').addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                showNextGalleryImage();
            });

            // Handle more thumbs button
            const moreThumbsBtn = document.getElementById('moreThumbsBtn');
            const thumbsContainer = document.querySelector('.thumbs-container');

            moreThumbsBtn.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();

                // Toggle expanded state
                const isExpanded = thumbsContainer.classList.contains('expanded');

                if (isExpanded) {
                    // If expanded, collapse and reset scroll
                    thumbsContainer.classList.remove('expanded');
                    thumbsContainer.scrollTop = 0;
                } else {
                    // If collapsed, expand
                    thumbsContainer.classList.add('expanded');
                }

                // Toggle button state
                this.classList.toggle('expanded');
            });

            // Close expanded thumbs when clicking outside
            document.addEventListener('click', function(e) {
                if (!thumbsContainer.contains(e.target) && !moreThumbsBtn.contains(e.target)) {
                    thumbsContainer.classList.remove('expanded');
                    thumbsContainer.scrollTop = 0;
                    moreThumbsBtn.classList.remove('expanded');
                }
            });

            // Handle mobile item clicks
            if (window.innerWidth <= 768) {
                const deItems = document.querySelectorAll('.de-item');

                deItems.forEach(item => {
                    const overlay = item.querySelector('.d-overlay');
                    const button = item.querySelector('.btn-main');

                    // Use click event for tap handling
                    overlay.addEventListener('click', function(e) {
                        // If clicked on button, don't do anything
                        if (e.target === button || button.contains(e.target)) {
                            return;
                        }

                        // Toggle active state
                        deItems.forEach(i => i.classList.remove('active'));
                        item.classList.add('active');
                    });

                    // Handle button click separately
                    button.addEventListener('click', function(e) {
                        e.stopPropagation();
                    });
                });

                // Remove active class when clicking outside
                document.addEventListener('click', function(e) {
                    if (!e.target.closest('.de-item')) {
                        deItems.forEach(item => item.classList.remove('active'));
                    }
                });
            }

            // Scroll to top button functionality
            const floatText = document.querySelector('.float-text');
            const scrollbarV = document.querySelector('.scrollbar-v');

            window.addEventListener('scroll', function() {
                if (window.pageYOffset > 300) {
                    floatText.classList.add('show-on-scroll');
                    scrollbarV.classList.add('show-on-scroll');
                } else {
                    floatText.classList.remove('show-on-scroll');
                    scrollbarV.classList.remove('show-on-scroll');
                }
            });

            // Smooth scroll to top when clicking the button
            document.querySelector('.float-text a').addEventListener('click', function(e) {
                e.preventDefault();
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });

            // Handle star rating with optimized performance
            const ratingStars = document.querySelectorAll('#ratingStars i');
            const ratingValue = document.getElementById('ratingValue');
            let currentRating = 0;

            // Function to update stars appearance
            function updateStars(index, isHover = false) {
                ratingStars.forEach((star, i) => {
                    if (i <= index) {
                        star.classList.remove('far');
                        star.classList.add('fas', 'text-warning');
                    } else {
                        star.classList.remove('fas', 'text-warning');
                        star.classList.add('far');
                    }
                });
            }

            // Add click event with debounce
            let clickTimeout;
            ratingStars.forEach((star, index) => {
                star.addEventListener('click', function() {
                    clearTimeout(clickTimeout);
                    clickTimeout = setTimeout(() => {
                        currentRating = index + 1;
                        ratingValue.value = currentRating;
                        updateStars(index);
                    }, 50);
                });

                // Optimized hover effect
                star.addEventListener('mouseover', function() {
                    const currentIndex = Array.from(ratingStars).indexOf(this);
                    updateStars(currentIndex, true);
                });
            });

            // Reset stars on mouse leave if no rating is selected
            document.getElementById('ratingStars').addEventListener('mouseleave', function() {
                if (currentRating === 0) {
                    ratingStars.forEach(star => {
                        star.classList.remove('fas', 'text-warning');
                        star.classList.add('far');
                    });
                } else {
                    updateStars(currentRating - 1);
                }
            });
        });

        // Handle float-text and scrollbar-v visibility
        var scrollTrigger = 100; // کاهش مقدار برای نمایش زودتر
        var t = 0;

        function backToTop() {
            var scrollTop = $(window).scrollTop();
            if (scrollTop > scrollTrigger) {
                $('.float-text').addClass('show');
                $('.scrollbar-v').addClass('show');
                t = 1;
            } else {
                $('.float-text').removeClass('show');
                $('.scrollbar-v').removeClass('show');
                t = 0;
            }
        }

        // استفاده از requestAnimationFrame برای عملکرد بهتر
        var ticking = false;
        $(window).on('scroll', function() {
            if (!ticking) {
                window.requestAnimationFrame(function() {
                    backToTop();
                    ticking = false;
                });
                ticking = true;
            }
        });

        // Initial check on page load
        $(document).ready(function() {
            backToTop();
        });
    </script>
</body>

</html>
