-- Thêm dữ liệu cho bảng fields
INSERT INTO
    `fields` (
        `name`,
        `slug`,
        `description`,
        `status`,
        `created_at`,
        `updated_at`
    )
VALUES
    (
        'Công nghệ thông tin',
        'cong-nghe-thong-tin',
        'Các bài viết về lập trình, phần mềm, phần cứng và công nghệ mới',
        1,
        NOW (),
        NOW ()
    ),
    (
        'Khoa học',
        'khoa-hoc',
        'Các bài viết về nghiên cứu khoa học, khám phá và phát minh',
        1,
        NOW (),
        NOW ()
    ),
    (
        'Điện tử',
        'dien-tu',
        'Các bài viết về điện tử, vi mạch và thiết bị điện tử',
        1,
        NOW (),
        NOW ()
    );

-- Thêm dữ liệu cho bảng categories
INSERT INTO
    `categories` (
        `name`,
        `slug`,
        `description`,
        `parent_id`,
        `field_id`,
        `created_at`,
        `updated_at`
    )
VALUES
    (
        'Lập trình Web',
        'lap-trinh-web',
        'Các bài viết về lập trình web, frontend, backend',
        NULL,
        1,
        NOW (),
        NOW ()
    ),
    (
        'Lập trình Mobile',
        'lap-trinh-mobile',
        'Các bài viết về phát triển ứng dụng di động',
        NULL,
        1,
        NOW (),
        NOW ()
    ),
    (
        'Trí tuệ nhân tạo',
        'tri-tue-nhan-tao',
        'Các bài viết về AI, machine learning',
        NULL,
        2,
        NOW (),
        NOW ()
    ),
    (
        'React.js',
        'reactjs',
        'Các bài viết về React.js và các thư viện liên quan',
        1,
        1,
        NOW (),
        NOW ()
    ),
    (
        'Vue.js',
        'vuejs',
        'Các bài viết về Vue.js và các thư viện liên quan',
        1,
        1,
        NOW (),
        NOW ()
    ),
    (
        'Flutter',
        'flutter',
        'Các bài viết về phát triển ứng dụng với Flutter',
        2,
        1,
        NOW (),
        NOW ()
    ),
    (
        'React Native',
        'react-native',
        'Các bài viết về phát triển ứng dụng với React Native',
        2,
        1,
        NOW (),
        NOW ()
    );

-- Thêm dữ liệu cho bảng posts
INSERT INTO
    `posts` (
        `title`,
        `slug`,
        `summary`,
        `content`,
        `category_id`,
        `field_id`,
        `author_id`,
        `status`,
        `published_at`,
        `created_at`,
        `updated_at`,
        `view_count`
    )
VALUES
    (
        'Hướng dẫn React Hooks cơ bản',
        'huong-dan-react-hooks',
        'Tìm hiểu về React Hooks và cách sử dụng',
        'Nội dung chi tiết về React Hooks...',
        4,
        1,
        1,
        'published',
        NOW (),
        NOW (),
        NOW (),
        0
    ),
    (
        'Vue.js 3 Composition API',
        'vuejs-3-composition-api',
        'Tìm hiểu về Composition API trong Vue.js 3',
        'Nội dung chi tiết về Composition API...',
        5,
        1,
        1,
        'published',
        NOW (),
        NOW (),
        NOW (),
        0
    ),
    (
        'Flutter vs React Native',
        'flutter-vs-react-native',
        'So sánh hai framework phát triển mobile',
        'Phân tích chi tiết về Flutter và React Native...',
        6,
        1,
        1,
        'published',
        NOW (),
        NOW (),
        NOW (),
        0
    ),
    (
        'Machine Learning cơ bản',
        'machine-learning-co-ban',
        'Giới thiệu về Machine Learning',
        'Nội dung chi tiết về Machine Learning...',
        3,
        2,
        1,
        'published',
        NOW (),
        NOW (),
        NOW (),
        0
    ),
    (
        'Xây dựng REST API với Node.js',
        'xay-dung-rest-api-nodejs',
        'Hướng dẫn xây dựng REST API',
        'Nội dung chi tiết về REST API...',
        1,
        1,
        1,
        'published',
        NOW (),
        NOW (),
        NOW (),
        0
    );

-- Thêm dữ liệu cho bảng tags
INSERT INTO
    `tags` (
        `name`,
        `slug`,
        `description`,
        `created_at`,
        `updated_at`
    )
VALUES
    (
        'React',
        'react',
        'Các bài viết về React',
        NOW (),
        NOW ()
    ),
    (
        'Vue.js',
        'vuejs',
        'Các bài viết về Vue.js',
        NOW (),
        NOW ()
    ),
    (
        'Flutter',
        'flutter',
        'Các bài viết về Flutter',
        NOW (),
        NOW ()
    ),
    (
        'React Native',
        'react-native',
        'Các bài viết về React Native',
        NOW (),
        NOW ()
    ),
    (
        'Machine Learning',
        'machine-learning',
        'Các bài viết về Machine Learning',
        NOW (),
        NOW ()
    ),
    (
        'Node.js',
        'nodejs',
        'Các bài viết về Node.js',
        NOW (),
        NOW ()
    );

-- Thêm dữ liệu cho bảng post_tag
INSERT INTO
    `post_tag` (`post_id`, `tag_id`)
VALUES
    (1, 1), -- React Hooks - React
    (2, 2), -- Vue.js 3 - Vue.js
    (3, 3), -- Flutter vs React Native - Flutter
    (3, 4), -- Flutter vs React Native - React Native
    (4, 5), -- Machine Learning - Machine Learning
    (5, 6);

-- REST API - Node.js