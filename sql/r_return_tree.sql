-- --------------------------------------------------------------------------------
-- Routine DDL
-- Note: comments before and after the routine body will not be stored by the server
-- --------------------------------------------------------------------------------
DELIMITER $$
DROP PROCEDURE `r_return_tree`;
CREATE PROCEDURE `r_return_tree`(

  IN computerID INT

)
  BEGIN
    -- Mostly for HTML select boxes

    SELECT
      n.fsID,
      CONCAT(REPEAT('..', COUNT(CAST(p.fsID AS CHAR)) - 1), n.fsName) AS Name
    FROM FileSystems AS n, FileSystems AS p
    WHERE (n.fsLft BETWEEN p.fsLft AND p.fsRgt) AND n.Computer = computerID
    GROUP BY fsID
    ORDER BY n.fsLft;

  END