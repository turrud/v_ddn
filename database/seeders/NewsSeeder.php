<?php

namespace Database\Seeders;

use App\Models\News;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // News::create([
        // 'name' => 'Ahmad Ghazy',
        // 'text' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta omnis ipsam consequuntur facilis ea quasi sunt praesentium velit delectus rem quidem tempora deleniti, ut obcaecati minus, et inventore at expedita labore cumque illum iusto quis! Consectetur laboriosam aspernatur fugiat ullam atque minima, nam doloremque in reprehenderit, ratione, recusandae unde quisquam veniam culpa aliquam dicta quaerat tempora. Dolorem et, placeat ipsa modi neque totam sequi sint quo autem deserunt officia sed delectus rerum, repellendus fugiat possimus iusto quam harum quibusdam odio excepturi eius porro libero est. Reiciendis expedita explicabo earum quibusdam nostrum debitis adipisci neque dolorem sint nisi iure, veniam laboriosam incidunt consequuntur ad numquam, cum aspernatur est, at aut minima nesciunt autem. Nesciunt vitae numquam assumenda, eos, minima velit labore, et in ipsam aliquid soluta repellendus sit sint? Laudantium, facere incidunt porro magnam dicta odit, quam quasi nisi id, minima placeat eveniet tenetur nesciunt commodi. Aperiam voluptas quae, distinctio recusandae quaerat enim officiis minima fuga culpa consequatur similique asperiores dignissimos veniam laudantium eaque dicta. Quae ad esse corrupti et assumenda eveniet, laudantium nam ratione praesentium iure quas quam quod qui unde fugit itaque architecto reiciendis explicabo. Assumenda illum beatae eligendi perferendis provident enim? Quibusdam labore laborum, aut assumenda error ab!',
        // 'excerpt' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit ...',
        // 'gambar' => 'https://res.cloudinary.com/dcaurcxth/image/upload/v1694609796/ddn/img/teams/um9nvrts0fmhhlzdp65n.jpg',
        // ]);
        // News::create([
        // 'name' => 'Ahmad Ghazy',
        // 'text' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta omnis ipsam consequuntur facilis ea quasi sunt praesentium velit delectus rem quidem tempora deleniti, ut obcaecati minus, et inventore at expedita labore cumque illum iusto quis! Consectetur laboriosam aspernatur fugiat ullam atque minima, nam doloremque in reprehenderit, ratione, recusandae unde quisquam veniam culpa aliquam dicta quaerat tempora. Dolorem et, placeat ipsa modi neque totam sequi sint quo autem deserunt officia sed delectus rerum, repellendus fugiat possimus iusto quam harum quibusdam odio excepturi eius porro libero est. Reiciendis expedita explicabo earum quibusdam nostrum debitis adipisci neque dolorem sint nisi iure, veniam laboriosam incidunt consequuntur ad numquam, cum aspernatur est, at aut minima nesciunt autem. Nesciunt vitae numquam assumenda, eos, minima velit labore, et in ipsam aliquid soluta repellendus sit sint? Laudantium, facere incidunt porro magnam dicta odit, quam quasi nisi id, minima placeat eveniet tenetur nesciunt commodi. Aperiam voluptas quae, distinctio recusandae quaerat enim officiis minima fuga culpa consequatur similique asperiores dignissimos veniam laudantium eaque dicta. Quae ad esse corrupti et assumenda eveniet, laudantium nam ratione praesentium iure quas quam quod qui unde fugit itaque architecto reiciendis explicabo. Assumenda illum beatae eligendi perferendis provident enim? Quibusdam labore laborum, aut assumenda error ab!',
        // 'excerpt' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit ...',
        // 'gambar' => 'https://res.cloudinary.com/dcaurcxth/image/upload/v1694609796/ddn/img/teams/um9nvrts0fmhhlzdp65n.jpg',
        // ]);
        // News::create([
        // 'name' => 'Ahmad Ghazy',
        // 'text' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta omnis ipsam consequuntur facilis ea quasi sunt praesentium velit delectus rem quidem tempora deleniti, ut obcaecati minus, et inventore at expedita labore cumque illum iusto quis! Consectetur laboriosam aspernatur fugiat ullam atque minima, nam doloremque in reprehenderit, ratione, recusandae unde quisquam veniam culpa aliquam dicta quaerat tempora. Dolorem et, placeat ipsa modi neque totam sequi sint quo autem deserunt officia sed delectus rerum, repellendus fugiat possimus iusto quam harum quibusdam odio excepturi eius porro libero est. Reiciendis expedita explicabo earum quibusdam nostrum debitis adipisci neque dolorem sint nisi iure, veniam laboriosam incidunt consequuntur ad numquam, cum aspernatur est, at aut minima nesciunt autem. Nesciunt vitae numquam assumenda, eos, minima velit labore, et in ipsam aliquid soluta repellendus sit sint? Laudantium, facere incidunt porro magnam dicta odit, quam quasi nisi id, minima placeat eveniet tenetur nesciunt commodi. Aperiam voluptas quae, distinctio recusandae quaerat enim officiis minima fuga culpa consequatur similique asperiores dignissimos veniam laudantium eaque dicta. Quae ad esse corrupti et assumenda eveniet, laudantium nam ratione praesentium iure quas quam quod qui unde fugit itaque architecto reiciendis explicabo. Assumenda illum beatae eligendi perferendis provident enim? Quibusdam labore laborum, aut assumenda error ab!',
        // 'excerpt' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit ...',
        // 'gambar' => 'https://res.cloudinary.com/dcaurcxth/image/upload/v1694609796/ddn/img/teams/um9nvrts0fmhhlzdp65n.jpg',
        // ]);
        // News::create([
        // 'name' => 'Ahmad Ghazy',
        // 'text' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta omnis ipsam consequuntur facilis ea quasi sunt praesentium velit delectus rem quidem tempora deleniti, ut obcaecati minus, et inventore at expedita labore cumque illum iusto quis! Consectetur laboriosam aspernatur fugiat ullam atque minima, nam doloremque in reprehenderit, ratione, recusandae unde quisquam veniam culpa aliquam dicta quaerat tempora. Dolorem et, placeat ipsa modi neque totam sequi sint quo autem deserunt officia sed delectus rerum, repellendus fugiat possimus iusto quam harum quibusdam odio excepturi eius porro libero est. Reiciendis expedita explicabo earum quibusdam nostrum debitis adipisci neque dolorem sint nisi iure, veniam laboriosam incidunt consequuntur ad numquam, cum aspernatur est, at aut minima nesciunt autem. Nesciunt vitae numquam assumenda, eos, minima velit labore, et in ipsam aliquid soluta repellendus sit sint? Laudantium, facere incidunt porro magnam dicta odit, quam quasi nisi id, minima placeat eveniet tenetur nesciunt commodi. Aperiam voluptas quae, distinctio recusandae quaerat enim officiis minima fuga culpa consequatur similique asperiores dignissimos veniam laudantium eaque dicta. Quae ad esse corrupti et assumenda eveniet, laudantium nam ratione praesentium iure quas quam quod qui unde fugit itaque architecto reiciendis explicabo. Assumenda illum beatae eligendi perferendis provident enim? Quibusdam labore laborum, aut assumenda error ab!',
        // 'excerpt' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit ...',
        // 'gambar' => 'https://res.cloudinary.com/dcaurcxth/image/upload/v1694609796/ddn/img/teams/um9nvrts0fmhhlzdp65n.jpg',
        // ]);
    }
}
