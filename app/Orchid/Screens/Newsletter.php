<?php

namespace App\Orchid\Screens;

use App\Models\User;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class Newsletter extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Рассылка уведомлений';
    }

    public function description(): ?string
    {
        return 'Страница для рассылки пользователям информационных уведомлений.';
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make('Send Message')
                ->icon('paper-plane')
                ->method('sendNotification')
        ];
    }

    /**
     * Views.
     *
     * @return iterable
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function layout(): iterable
    {
        return [
            Layout::rows([
                Relation::make('users.')
                    ->title('Получатель')
                    ->multiple()
                    ->required()
                    ->placeholder('Имя пользователя')
                    ->help('В этом поле выбирается пользователь, которому будет отправлено сообщение')
                    ->fromModel(TelegramUser::class,'name','chat_id'),
                TextArea::make('text')
                    ->title('Текст уведомления')
                    ->help("*жирный* _курсив_ __подчеркнутый__ ~зачеркнутый~ ||спойлер||")
                    ->rows(5),
            ])
        ];
    }

    public function sendNotification(Request $request)
    {
        $request->validate([
            'users' => 'required',
            'text' => 'required|string',
        ]);



    }

}
