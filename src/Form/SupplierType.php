<?php

namespace App\Form;

use App\Entity\Supplier;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SupplierType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('description', TextType::class)
            ->add('image', FileType::class)
			->add('handlerId', ChoiceType::class, [
				'choice_loader' => new CallbackChoiceLoader(function() {
					$handlers = [];
					$list = HandlerCollection::instance()->getList('in');
					foreach($list as $item)
						$handlers[$item->getId()] = $item->getName();
					return $handlers;
				}),
			])
			// Сюда еще надо будет каким-то неведомым способом внедрить настройки Options
			// выбранного обработчика handlerId, который на выходе будет давать ассоциативный 
			// массив или сразу Объект Config. Это точно кастомное поле, вопрос лишь в том нужно ли будет 
			// использовать прямо внутри объект Request или нет
			// ->add('options')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Supplier::class,
        ]);
    }
}
