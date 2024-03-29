-- ----------------------------
-- 频道表
-- ----------------------------
create table channels(
  id                     int(10)       not null auto_increment comment '频道编号',
  channel_name           varchar(20)   not null                comment '频道名词',
  channel_short_name     varchar(20)            default null   comment '',
  channel_item_unit      varchar(20)            default null   comment '',
  read_me                varchar(255)           default null   comment '',
  meta_keywords          varchar(255)           default null   comment '',
  meta_description       varchar(255)           default null   comment '',
  channel_pic_url        varchar(50)            default null   comment '',
  order_id               int(3)        not null                comment '',
  open_type              int(3)        not null default '0'    comment '',
  channel_type           int(10)       not null                comment '',
  link_url               varchar(200)           default null   comment '',
  channel_dir            varchar(50)            default null   comment '',
  module_type            int(10)                default null   comment '',
  disabled               tinyint(1)    not null default '0'    comment '',
  show_name              tinyint(1)    not null default '0'    comment '是否在频道栏显示频道名称',
  show_name_on_path      tinyint(1)             default '0'    comment '是否在导航栏显示频道名称',
  show_class_tree_guide  tinyint(1)    not null default '0'    comment '是否在本频道显示树状导航菜单',
  show_suspension_points tinyint(1)             default '0'    comment '前台是否显示标题后的省略号',
  check_level            int(10)       not null default '0'    comment '',
  enable_upload_file     tinyint(1)    not null default '0'    comment '',
  upload_dir             varchar(50)            default null   comment '',
  max_file_size          int(10)                default null   comment '',
  hits_of_hot            int(10)                default null   comment '',
  days_of_new            int(10)                default null   comment '',
  max_per_line           int(10)                default null   comment '',
  up_file_type           varchar(255)           default null   comment '',
  default_skin_id        int(10)                default null   comment '',
  template_index         int(10)                default null   comment '',
  top_menu_type          int(10)                default null   comment '',
  class_guide_type       int(10)                default null   comment '',
  use_create_html        int(10)       not null default '0'    comment '',
  item_count             int(10)                default null   comment '',
  item_checked           int(10)                default null   comment '',
  comment_count          int(10)                default null   comment '',
  special_count          int(10)                default null   comment '',
  hits_count             int(10)                default null   comment '',
  structure_type         int(10)                default '0'    comment '',
  list_file_type         int(10)                default '0'    comment '',
  file_name_type         int(10)                default '0'    comment '',
  auto_create_type       int(10)                default '0'    comment '',
  file_ext_index         int(10)                default '0'    comment '',
  file_ext_list          int(10)                default '0'    comment '',
  file_ext_item          int(10)                default '0'    comment '',
  update_pages           int(10)                default '0'    comment '',
  channel_purview        int(10)                default '0'    comment '',
  arrgroupid             varchar(255)           default null   comment '',
  js_special_num         int(10)                default '0'    comment '',
  author_info_len        int(10)                default '0'    comment '',
  max_per_page_index     int(10)                default '0'    comment '',
  max_per_page_search_result  int(10)           default '0'    comment '',
  max_per_page_new       int(10)                default '0'    comment '',
  max_per_page_hot       int(10)                default '0'    comment '',
  max_per_page_elite     int(10)                default '0'    comment '',
  max_per_page_special_list   int(11)           default '0'    comment '',
  money_per_kw           double                 default '0'    comment '',
  timing_create_setting  longtext                              comment '',
  email_of_reject        longtext                              comment '',
  email_of_passed        longtext                              comment '',
  custom_content         longtext                              comment '',
  arrenabledtabs         varchar(200)           default null   comment '',
  command_channel_point  int(10)                default null   comment '',
  fields_options         longtext                              comment '',
  PRIMARY KEY (id)
)engine=MyISAM default charset=utf8 comment='频道';


-- ----------------------------
-- 栏目表
-- ----------------------------
create table webpages (
  id                     int(10)       not null auto_increment comment '栏目编号',
  channel_id             int(10)       not null                comment '频道',
  page_name              varchar(50)   not null                comment '栏目名称',
  page_type              int(10)       not null                comment '栏目类型',
  open_type              int(10)       not null                comment '',
  parent_id              int(10)       not null                comment '',
  parent_path            varchar(50)   not null                comment '',
  depth                  int(10)       not null                comment '',
  root_id                int(10)       not null                comment '',
  child                  int(10)       not null                comment '',
  arrchildid             longtext                              comment '',
  prev_id                int(10)       not null                comment '',
  next_id                int(10)       not null                comment '',
  order_id               int(10)       not null                comment '',
  tips                   varchar(255)            default null  comment '',
  read_me                longtext                              comment '',
  meta_keywords          varchar(255)            default null  comment '',
  meta_description       varchar(255)            default null  comment '',
  link_url               varchar(255)            default null  comment '',
  page_pic_url           varchar(255)            default null  comment '',
  page_dir               varchar(50)             default null  comment '',
  parent_dir             longtext                              comment '',
  skin_id                int(10)                 default null  comment '',
  template_id            int(11)                 default null  comment '',
  show_on_top            tinyint(1)     not null default '0'   comment '',
  show_on_index          tinyint(1)     not null default '0'   comment '',
  is_elite               tinyint(1)     not null default '0'   comment '',
  enable_add             tinyint(1)     not null default '0'   comment '',
  enable_protect         tinyint(1)     not null default '0'   comment '',
  max_per_page           int(10)                 default null  comment '',
  default_item_template  int(10)                 default null  comment '',
  default_item_skin      int(10)                 default null  comment '',
  item_list_order_type   int(10)                 default null  comment '',
  item_open_type         int(10)                 default null  comment '',
  item_count             int(10)                 default null  comment '',
  page_purview           tinyint(1)     unsigned default '0'   comment '',
  enable_comment         tinyint(1)              default '0'   comment '',
  check_comment          tinyint(1)              default '0'   comment '',
  present_exp            double                  default '0'   comment '',
  default_item_point     double                  default '0'   comment '',
  default_item_charge_type    int(10)            default '0'   comment '',
  default_item_pitch_time     int(10)            default '0'   comment '',
  default_item_read_times     int(10)            default '0'   comment '',
  default_item_divide_percent int(10)            default '0'   comment '',
  custom_content         longtext                              comment '',
  command_page_point    int(10)                 default null   comment '',
  release_page_point    int(10)                 default null   comment '',
  PRIMARY KEY (id)
)engine=MyISAM default charset=utf8 comment='栏目';


-- ----------------------------
-- 文章表
-- ----------------------------
create table articles(
  id                    int(10)       not null auto_increment comment '文章编号',
  channel_id            int(10)       not null                comment '频道',
  webpage_id            int(10)       not null                comment '类别',
  title                 varchar(255)  not null                comment '标题',
  title_intact          varchar(255)                          comment '完整标题',
  subheading            varchar(255)                          comment '副标题',
  author                varchar(255)                          comment '作者',
  copy_from             varchar(255)                          comment '',
  inputer               varchar(20)                           comment '',
  link_url              varchar(255)                          comment '',
  editor                varchar(20)                           comment '',
  keyword               varchar(255)                          comment '关键字',
  hits                  int(10)                               comment '点击次数',
  comment_count         int(5)                                comment '评论次数',
  modified              timestamp                             comment '修改时间',
  created               timestamp                             comment '创建时间',
  on_top                int(1)                                comment '置顶',
  elite                 int(1)                                comment '置精',
  status                int(1)                                comment '状态',
  content               longtext                              comment '内容',  
  include_pic           int(2)        not null default '0'    comment '上次图片个数',
  default_pic_url       varchar(255)           default null   comment '默认图片',
  upload_files          varchar(255)                          comment '上次文件',
  info_point            int(10)                default null   comment '',
  pagination_type       tinyint(1)             default null   comment '分页类型',
  deleted               tinyint(1)    not null default '0'    comment '删除标志',
  skin_id               int(10)                default null   comment '皮肤',
  template_id           int(10)                default null   comment '模板',
  stars                 tinyint(1)             default null   comment '评星',
  title_font_color      varchar(7)             default null   comment '标题字体颜色',
  title_font_type       varchar(120)           default null   comment '标题字体类型',
  max_char_per_page     int(10)                default null   comment '每页字数',
  show_comment_link     tinyint(1)    not null default '0'    comment '显示评论链接',
  receive               tinyint(1)             default '0'    comment '接收标志',
  receive_user          varchar(120)                          comment '接收者',
  received              varchar(120)                          comment '',
  auto_receive_time     int(10)                default '0'    comment '自动接收时间',
  receive_type          int(10)                default '0'    comment '',
  introduction          longtext                              comment '',
  present_exp           double                 default '0'    comment '',
  copy_money            double                 default '0'    comment '',
  is_payed              tinyint(1)             default '0'    comment '',
  beneficiary           varchar(200)           default null   comment '',
  pay_date              timestamp                             comment '',
  vote_id               int(10)                default '0'    comment '',
  info_purview          int(10)                default '0'    comment '',
  arr_group_id          varchar(255)           default null   comment '',
  charge_type           int(10)                default '0'    comment '',
  pitch_time            int(10)                default '0'    comment '',
  read_times            int(10)                default '0'    comment '',
  divide_percent        int(10)                default '0'    comment '',
  blog_id               int(10)                default '0'    comment '', 
  primary key (id)
) engine=MyISAM default charset=utf8 comment='文章';


-- ----------------------------
-- 标签表
-- ----------------------------
create table tags (
  `id`                    int(10)       not null auto_increment comment '编号',
  `name`                  varchar(100)           default null   comment '名称',
  primary key  (`id`)
) engine=MyISAM default charset=utf8 comment='标签';


-- ----------------------------
-- 文章标签对应表
-- ----------------------------
create table articles_tags (
  article_id              int(10)       not null default '0',
  tag_id                  int(10)       not null default '0',
  primary key  (article_id,tag_id)
) engine=myisam default charset=utf8;


-- ----------------------------
-- 存放视频文件名称表
-- ----------------------------
create table videos (
  `id`                    int(10)       not null auto_increment comment '编号',
  `name`                  varchar(100)           default null   comment '文件名称',
  upload_date              timestamp                             comment '上传日期',
  primary key  (`id`)
) engine=MyISAM default charset=utf8 comment='视频文件名称表';