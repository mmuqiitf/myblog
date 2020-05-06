<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">
    <title>{{ $title ?? 'Faturrahman - Blog' }}</title>
    <!-- Bootstrap core CSS -->
    <link href="{{ asset('app/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;500;600;700&family=Raleway:wght@100;200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="{{ asset('app/css/jquery.bxslider.css') }}" rel="stylesheet">
    <link href="{{ asset('app/css/style.css') }}" rel="stylesheet">
    <style>
        .btn-like-post {
            padding: 10px 17px;
        }

        .btn-like-post,
        .btn-like-comment {
            display: block;
            text-align: center;
            background: #ed2553;
            border-radius: 3px;
            box-shadow: 0 10px 20px -8px rgb(240, 75, 113);
            font-size: 18px;
            cursor: pointer;
            border: none;
            outline: none;
            color: #ffffff;
            text-decoration: none;
            -webkit-transition: 0.3s ease;
            transition: 0.3s ease;
        }

        .btn-like-comment {
            padding: 4px 11px;
        }

        .animate-like {
            animation-name: likeAnimation;
            animation-iteration-count: 1;
            animation-fill-mode: forwards;
            animation-duration: 0.65s;
        }
        .like_number, .like_desc{
            font-size: 15px;
            color: black;
        }

        @keyframes likeAnimation {
            0% {
                transform: scale(30);
            }

            100% {
                transform: scale(1);
            }
        }

        .comment-section {
            list-style: none;
            width: 100%;
            margin: 20px auto;
            padding: 10px;
        }

        .comment {
            display: flex;
            border-radius: 3px;
            flex-wrap: wrap;
        }

        .comment.user-comment {
            color: #808080;
        }

        .comment.author-comment {
            color: #60686d;
            justify-content: flex-end;
        }

        /* User and time info */

        .comment .info {
            width: 17%;
        }

        .comment.user-comment .info {
            text-align: right;
        }

        .comment.author-comment .info {
            order: 3;
        }

        .comment .info a {
            /* User name */
            display: block;
            text-decoration: none;
            color: #656c71;
            font-weight: bold;
            text-overflow: ellipsis;
            overflow: hidden;
            white-space: nowrap;
            padding: 10px 0 3px 0;
        }

        .comment .info span {
            /* Time */
            font-size: 11px;
            color: #9ca7af;
        }


        /* The user avatar */

        .comment .avatar {
            width: 8%;
        }

        .comment.user-comment .avatar {
            padding: 10px 18px 0 3px;
        }

        .comment.author-comment .avatar {
            order: 2;
            padding: 10px 3px 0 18px;
        }

        .comment .avatar img {
            display: block;
            border-radius: 50%;
        }

        .comment.user-comment .avatar img {
            float: right;
        }

        /* The comment text */

        .comment p {
            line-height: 1.5;
            padding: 18px 22px;
            width: 50%;
            position: relative;
            word-wrap: break-word;
        }

        .comment.user-comment p {
            background-color: #f3f3f3;
        }

        .comment.author-comment p {
            background-color: #e2f8ff;
            order: 1;
        }

        .comment.user-comment p,
        .comment.author-comment p {
            margin: 10px;
        }

        .user-comment p:after {
            content: '';
            position: absolute;
            width: 25px;
            height: 25px;
            border-radius: 50%;
            background-color: #ffffff;
            border: 2px solid #f3f3f3;
            left: -8px;
            top: 18px;
        }

        .author-comment p:after {
            content: '';
            position: absolute;
            width: 25px;
            height: 25px;
            border-radius: 50%;
            background-color: #ffffff;
            border: 2px solid #e2f8ff;
            right: -8px;
            top: 18px;
        }

    </style>
</head>
