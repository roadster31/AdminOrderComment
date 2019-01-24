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
 * Date: 24/01/2019 16:12
 */
namespace AdminOrderComment\Hook;

use AdminOrderComment\Model\AdminOrderCommentQuery;
use Thelia\Core\Event\Hook\HookRenderEvent;
use Thelia\Core\Hook\BaseHook;

class BackHook extends BaseHook
{
    public function onOrderEditAfterOrderProductList(HookRenderEvent $event)
    {
        $orderId = $event->getArgument('order_id');

        if (null !== $aoc = AdminOrderCommentQuery::create()->findOneByOrderId($orderId)) {
            $comment = $aoc->getComment();
        } else {
            $comment = '';
        }

        $event->add(
            $this->render(
                "order-edit.html",
                [
                    'order_id' => $orderId,
                    'comment' => $comment
                ]
            )
        );
    }
}
