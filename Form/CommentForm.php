<?php
/*************************************************************************************/
/*      Copyright (c) Franck Allimant, CQFDev                                        */
/*      email : thelia@cqfdev.fr                                                     */
/*      web : http://www.cqfdev.fr                                                   */
/*                                                                                   */
/*      For the full copyright and license information, please view the LICENSE      */
/*      file that was distributed with this source code.                             */
/*************************************************************************************/

/**
 * Created by Franck Allimant, CQFDev <franck@cqfdev.fr>
 * Date: 24/01/2019 16:00
 */
namespace AdminOrderComment\Form;

use AdminOrderComment\AdminOrderComment;
use Symfony\Component\Validator\Constraints\NotBlank;
use Thelia\Form\BaseForm;

class CommentForm extends BaseForm
{
    public function buildForm()
    {
        $this->formBuilder
            ->add(
                'comment',
                'textarea',
                [
                    'constraints' => [
                        new NotBlank()
                    ],
                    'label' => $this->translator->trans('Commentaire sur cette commande', [], AdminOrderComment::DOMAIN_NAME),
                    'label_attr' => [
                        'help' => $this->translator->trans('Indiquer ici un commentaire sure cette commande.', [], AdminOrderComment::DOMAIN_NAME)
                    ],
                    'attr' => [
                        'rows' => 2
                    ]
                ]
            )
        ;
    }

    public function getName()
    {
        return "admin_order_comment_form";
    }
}
