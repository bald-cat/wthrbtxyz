<?php

namespace App\Orchid\Screens;

use App\Facades\TelegramMessage;
use App\Models\TelegramUser;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\Request;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
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
     * @return Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make('Отправить уведомления')
                ->icon('paper-plane')
                ->method('sendNotification')
        ];
    }

    /**
     * Views.
     *
     * @return iterable
     * @throws BindingResolutionException
     */
    public function layout(): iterable
    {
        return [
            Layout::rows([
                Select::make('users.')
                    ->title('Получатель')
                    ->multiple()
                    ->placeholder('Имя пользователя')
                    ->help('В этом поле выбирается пользователь, которому будет отправлено сообщение')
                    ->fromModel(TelegramUser::class, 'name', 'chat_id'),

                CheckBox::make('all')
                ->title('Все пользователи')
                ->help('Уведомления будут разосланы всем пользователям'),

                TextArea::make('text')
                    ->title('Текст уведомления')
                    ->required()
                    ->help("Можно использовать html теги")
                    ->rows(5),
            ])
        ];
    }

    public function sendNotification(Request $request)
    {
        $request->validate([
            'text' => 'required|string',
        ]);

        $usersChatId = $request->input('all') ? TelegramUser::pluck('chat_id')->all() : $request->input('users');

        foreach ($usersChatId as $userChatId) {
            TelegramMessage::setChatId($userChatId)->setText($request->input('text'))->send();
        }

        Alert::info('Уведомления пользователям были успешно разосланы');

    }

}
