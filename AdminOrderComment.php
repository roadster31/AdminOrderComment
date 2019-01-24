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
 * Date: 24/01/2019 16:34
 */
namespace AdminOrderComment;

use AdminOrderComment\Model\AdminOrderCommentQuery;
use Propel\Runtime\Connection\ConnectionInterface;
use Thelia\Install\Database;
use Thelia\Module\BaseModule;

class AdminOrderComment extends BaseModule
{
    /** @var string */
    const DOMAIN_NAME = 'adminordercomment';

    public function postActivation(ConnectionInterface $con = null)
    {
        try {
            AdminOrderCommentQuery::create()->findOne();
        } catch (\Exception $e) {
            $database = new Database($con->getWrappedConnection());
            $database->insertSql(null, array(__DIR__ . '/Config/thelia.sql'));
        }
    }
}
