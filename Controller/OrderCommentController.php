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
namespace AdminOrderComment\Controller;

use AdminOrderComment\Model\AdminOrderComment;
use AdminOrderComment\Model\AdminOrderCommentQuery;
use Front\Front;
use Thelia\Controller\Admin\BaseAdminController;
use Thelia\Core\Translation\Translator;
use Thelia\Form\Exception\FormValidationException;
use Thelia\Tools\URL;

/**
 * Class OrderCommentController
 * @package OrderComment\Controller
 */
class OrderCommentController extends BaseAdminController
{
    public function setComment()
    {
        $message = false;
        $commentForm = new \AdminOrderComment\Form\CommentForm($this->getRequest());

        $orderId = intval($this->getRequest()->get('order_id'));

        try {
            $form = $this->validateForm($commentForm);

            $data = $form->getData();

            if (null === $aoc = AdminOrderCommentQuery::create()->findOneByOrderId($data['order_id'])) {
                $aoc = (new AdminOrderComment())->setOrderId($data['order_id']);
            }

            $aoc->setComment($data['comment'])->save();
        } catch (FormValidationException $e) {
            $message = Translator::getInstance()->trans("Please check your input: %s", ['%s' => $e->getMessage()], Front::MESSAGE_DOMAIN);
        } catch (\Exception $e) {
            $message = Translator::getInstance()->trans("Sorry, an error occurred: %s", ['%s' => $e->getMessage()], Front::MESSAGE_DOMAIN);
        }

        if ($message !== false) {
            $commentForm->setErrorMessage($message);

            $this->getParserContext()
                ->addForm($commentForm)
                ->setGeneralError($message)
            ;
        }

        return $this->generateRedirect(
            URL::getInstance()->absoluteUrl('/admin/order/update/' . $orderId).'#order-comment'
        );
    }
}
