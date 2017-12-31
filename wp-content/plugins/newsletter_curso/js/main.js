jQuery(document).ready(function($)
{
    $('#subscriber-form').submit(function(e)
        {
            e.preventDefault();
            
            let subscriberData = $(this).serialize();

            $.ajax(
                {
                    type: 'post',
                    url: $(this).attr('action'),
                    data: subscriberData
                }
            ).done(function(response)
                {
                    $('#form-msg').text(response); 
                    $('#name').val('');
                    $('#email').val('');
                    console.log(response);
                }
            ).fail(function(data)
                {
                    if(data.response !== '')
                    {
                        $('#form-msg').text(data.responseText);
                        console.log(data.responseText);
                    }
                    else
                    {
                        $('#form-msg').text('A mensagem não pode ser enviada!');
                        console.log('A mensagem não pode ser enviada!');
                    }
                }
            );
        }
    );
    
});